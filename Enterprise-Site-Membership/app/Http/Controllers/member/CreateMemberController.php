<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class CreateMemberController extends Controller
{
    public function index() {
        return view('member/CreateMember');
    }

    public function sendEmail() {

        Http::asForm()->post("http://crm3.saramin.co.kr/mail_api/automails",
            [
            'autotype'=>'A0264',
            'cmpncode'=>'13523',
            'email'=>'ychyun@saramin.co.kr',
            'sender_email'=>'ychyun@saramin.co.kr',
            'use_event_solution'=>'y',
            'replace15'=>'안녕하세요 테스트 이메일입니다.',
            'title'=>'테스트중입니다.'
            ]
        );
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
        $member->mem_pw = Crypt::encryptString(request('password'));
        $member->mem_name = request('name');
        $member->mem_tel = request('tel');
        $member->mem_birth = request('birth');
        $member->stat_idx = 1;
        $member->mem_update_pw_dt = now();
        $member->mem_last_login_dt = now();

        $member->save();

        return redirect('/');
    }
}
