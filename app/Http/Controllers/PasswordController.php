<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\throwException;

class PasswordController extends Controller
{
    public function edit()
    {   
        return view('admin/password/passwordUpdate');
    }

    public function update(PasswordUpdateRequest $request)
    {   

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $current_password = auth()->user()->password;
        
        $user = User::findOrFail(auth()->id());

        
        if(Hash::check($old_password, $current_password)) {
            $user->update([
                'password' => bcrypt($new_password),
            ]); 
            return redirect('admin/profile')->with('message', 'Your password is updated successfully');
        } else {
            // throwException();
        }
    }
}
