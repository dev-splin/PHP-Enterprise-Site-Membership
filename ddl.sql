CREATE TABLE member (
    mem_idx INT NOT NULL AUTO_INCREMENT COMMENT '사용자 인덱스',
    mem_email VARCHAR(256) NOT NULL COMMENT '이메일(로그인 id 겸용)',
    mem_pw VARCHAR(20) NOT NULL COMMENT '비밀번호',
    mem_name VARCHAR(20) NOT NULL COMMENT '이름',
    mem_tel VARCHAR(13) NOT NULL COMMENT '전화번호',
    mem_birth DATE NOT NULL COMMENT '생년월일',
    mem_create_dt TIMESTAMP NOT NULL COMMENT '가입일',
    mem_update_dt TIMESTAMP NOT NULL COMMENT '정보 변경일',
    mem_update_pw_dt TIMESTAMP NOT NULL COMMENT '비밀번호 변경일',
    mem_last_login_dt TIMESTAMP NOT NULL COMMENT '마지막 로그인일',
    stat_idx INT NOT NULL COMMENT '사용자 상태 정보',
    PRIMARY KEY(mem_idx),
    FOREIGN KEY(stat_idx) REFERENCES state (stat_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE state (
    stat_idx INT NOT NULL AUTO_INCREMENT COMMENT '상태 정보 인덱스',
    stat_name VARCHAR(15) NOT NULL DEFAULT 'NORMAL' COMMENT '상태 정보 이름',
    PRIMARY KEY(stat_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE log_type (
    log_type_idx INT NOT NULL AUTO_INCREMENT COMMENT '로그 종류 인덱스',
    log_type_name VARCHAR(15) NOT NULL COMMENT '로그 종류 이름',
    PRIMARY KEY(log_type_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE member_active_log (
    mem_active_log_dt TIMESTAMP NOT NULL COMMENT '사용자의 활동 로그(날짜)',
    mem_active_log_idx INT NOT NULL AUTO_INCREMENT COMMENT '사용자의 활동 로그 인덱스',
    mem_idx INT NOT NULL COMMENT '사용자 인덱스',
    log_type_idx INT NOT NULL COMMENT '로그 종류 인덱스',
    PRIMARY KEY(mem_active_log_dt, mem_active_log_idx, mem_idx),
    FOREIGN KEY(log_type_idx) REFERENCES log_type (log_type_idx),
    INDEX mem_active_log_idx (mem_active_log_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE admin (
    admin_idx INT NOT NULL AUTO_INCREMENT COMMENT '관리자 인덱스',
    admin_id VARCHAR(20) NOT NULL COMMENT '로그인 id',
    admin_pw VARCHAR(20) NOT NULL COMMENT '비밀번호',
    admin_name VARCHAR(20) NOT NULL COMMENT '이름',
    admin_tel VARCHAR(13) NULL COMMENT '전화번호',
    admin_email VARCHAR(256) NOT NULL COMMENT '이메일',
    PRIMARY KEY(admin_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;