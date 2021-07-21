<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\member;
use Illuminate\Http\Request;

class CreateMemberController extends Controller
{
    public function index() {
        return view('member/CreateMember');
    }

    public function checkEmail() {

        $email = member::where('mem_email', request('email'))
            ->count();

        return $email;
    }

    public function create() {

        request()->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'tel' => 'required',
            'birth' => 'required'
        ]);

        $member = new member;
        $member->mem_email = request('email');
        $member->mem_pw = request('password');
        $member->mem_name = request('name');
        $member->mem_tel = request('tel');
        $member->mem_birth = request('birth');
        $member->stat_idx = 1;
        $member->mem_update_pw_dt = now();
        $member->mem_last_login_dt = now();

        $member->save();

        return view('Main');
    }
}
