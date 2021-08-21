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

    // 이메일 코드 전송
    public function sendEmail() {

        $collection = collect([0,1,2,3,4,5,6,7,8,9]);
        $shuffled = $collection->shuffle()->skip(4)->implode("");

        Http::asForm()->post("http://crm3.saramin.co.kr/mail_api/automails",
            [
            'autotype'=>'A0264',
            'cmpncode'=>'13523',
            'email'=>request('email'),
            'sender_email'=>'ychyun@saramin.co.kr',
            'use_event_solution'=>'y',
            'replace15'=>'회원 가입 이메일 인증 코드 : ' + $shuffled,
            'title'=>'회원 가입 이메일 인증 코드 입니다.'
            ]
        );

        return $shuffled;
    }

    // 이메일 중복 확인
    public function checkEmail() {

        $email = member::where('mem_email', request('email'))
            ->count();

        return $email;
    }

    // 사용자 생성
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
        $member->mem_tel = Crypt::encryptString(request('tel'));
        $member->mem_birth = request('birth');
        $member->stat_idx = 1;
        $member->mem_update_pw_dt = now();
        $member->mem_last_login_dt = now();

        $member->save();

        return redirect('/');
    }
}
