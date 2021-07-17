# 1️⃣ 엔터프라이즈급 사이트 멤버쉽 구성

가장 기본적이지만 민감하고 중요한 회원정보의 암호화 방법, 인증 방법, 유효성 검사, 휴면 정책 등을 PHP로 경험해보고 확장성있고 더 효율적인 방법을 찾아보면서 PHP와 웹에 익숙해 지기 위한 프로젝트입니다.



## 📜 상세 내용

[![Notion Badge](http://img.shields.io/badge/-상세내용(노션링크)-orange?style=flat&logo=Notion&link=https://www.notion.so/IT-OJT-1-5cc78eb055e949c3abfac12efb125313#fe50e20073884de791d792eca02cfefb)](https://www.notion.so/IT-OJT-1-5cc78eb055e949c3abfac12efb125313#fe50e20073884de791d792eca02cfefb)

### 기능 명세

#### 사용자

1. 회원가입

   - 이메일 인증 적용

   - (최소입력필드) 이메일 , 이름, 전화번호, 생년월일, 패스워드
      (If Possible) 프로필 사진 (이미지 업로드)
   - 패스워드 복잡성 적용
   - 입력 항목 실시간 validation 적용

2. 로그인  , 로그인 유지 기능
3. 로그아웃
4. 개인 정보 확인/ 수정
5. 패스워드 변경은 별도 구현 ( 변경전 email을 통한 인증번호  검증 프로세스 적용)
6. 회원탈퇴 ( email을 통한 인증번호  검증 프로세스 적용 )
7. 로그인, 로그아웃 기록(로그)



#### 관리자

1. 로그인, 로그아웃 유지 기능
2. 회원 정보 리스트
3. 회원 정보 검색
4. 회원 정보 수정
5. 회원 블락 / 해제



### 휴면 정책 적용

휴면계정 정책 적용  (법은 물리적으로 분리된 DB에  이전 보관이나 , 개발편의상 논리적으로 분리된 DB에 분리 보관)

- 휴면처리: 1주일이상 접속하지 않은 사용자 정보 휴면 DB로 분리 보관
- 휴면해제처리: 휴면 처리된 사용자가 Site로그인하고 등록된 Email로 인증 메일을 발송하고 인증완료시 휴면 해제



### 보안 정책 적용 사항

- 패스워드 : DB에 단방향 암호화하여 저장
- 전화번호 : 양방향 암호화 저장하여 저장



### Flow Chart

#### 사용자

<img src="https://user-images.githubusercontent.com/79291114/126042373-4ee38f61-982a-463e-abfe-e6d24a1d6ab0.png" alt="UserFlow" style="zoom: 67%;" />



#### 관리자

<img src="https://user-images.githubusercontent.com/79291114/126042369-8e687a45-ad0c-416c-84d8-7d4881849e82.png" alt="AdminFlow" style="zoom:67%;" />



### 데이터 베이스 설계도

![DB-blueprint_white](https://user-images.githubusercontent.com/79291114/126042368-54011367-4ae2-4930-bac7-13698757bbec.png)



### WBS(Work Breakdown Structure)

![WBS](https://user-images.githubusercontent.com/79291114/126042378-bd1292af-a45f-4acc-9b55-9d875e03f733.PNG)

