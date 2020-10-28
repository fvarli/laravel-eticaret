<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;

class UserController extends Controller
{

    public function index()
    {
        // TODO filter by is_active or is_admin
        if (request()->filled('search')) {
            request()->flash();
            $search = request('search');
            $user_list = User::where('full_name', 'like', "%$search%")
                ->orWhere('id', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orderByDesc('created_at')
                ->paginate(10)
                ->appends('search', $search);
        } else {
            request()->flush();
            $user_list = User::orderByDesc('created_at')->paginate(10);
        }
        //print_r($user_list);
        return view('admin.user.index', compact('user_list'));
    }

    public function login()
    {
        if (request()->isMethod('POST')) {
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('password'),
                'is_admin' => 1,
                'is_active' => 1
            ];

            if (Auth::guard('admin')->attempt($credentials, request()->has('remember_me'))) {
                return redirect()->route('admin.home');
            } else {
                return back()->withInput()->withErrors(['email' => 'Email is not correct. - or', 'password' => 'Password is not correct. - or', 'is_admin' => 'The user is not an admin.']);
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('admin.login');
    }

    public function form($id = null)
    {
        $list = new User;
        if ($id != null) {
            $list = User::find($id);
        }

        return view('admin.user.form', compact('list'));
    }

    public function save($id = null)
    {
        $this->validate(request(), [
            'full_name' => 'required',
            'email' => 'required|email'
        ]);

        $data = request()->only('full_name', 'email');
        if (request()->filled('password')) {
            $data['password'] = Hash::make(request('password'));
        }
        $data['is_active'] = request()->has('is_active') && request('is_active') == 1 ? 1 : 0;
        $data['is_admin'] = request()->has('is_admin') && request('is_admin') == 1 ? 1 : 0;

        if ($id != null) {
            $list = User::where('id', $id)->firstOrFail();
            $list->update($data);
        } else {
            $list = User::create($data);
        }

        UserDetail::updateOrCreate(
            ['user_id' => $list->id],
            [
                'address' => request('address'),
                'phone' => request('phone'),
                'cell_phone' => request('cell_phone')
            ]
        );

        return redirect()
            ->route('admin.user.edit', $list->id)
            ->with('message_type', 'success')
            ->with('message', ($id != null ? 'Updated' : 'Saved'));
    }

    public function delete($id)
    {
        $user_delete = User::destroy($id);

        if ($user_delete) {
            return redirect()
                ->route('admin.user')
                ->with('message_type', 'success')
                ->with('message', 'User has been deleted');
        } else {
            return redirect()
                ->route('admin.user')
                ->with('message_type', 'error')
                ->with('message', 'User couldn\'t deleted');
        }
    }
}
