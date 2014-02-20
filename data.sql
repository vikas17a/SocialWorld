CREATE database sw;
USE sw;
CREATE table sw_ulogin (u_id int(5) auto_increment, email varchar(50), PRIMARY KEY(u_id), UNIQUE KEY(email),password varchar(64) not null, type varchar(5) not null);
CREATE table sw_city (c_id int(5) auto_increment,c_name varchar(20) not null,PRIMARY KEY(c_id), UNIQUE KEY(c_name));
CREATE table sw_state (s_id int(4) auto_increment,s_name varchar(20) not null, PRIMARY KEY(s_id),UNIQUE KEY(s_name));
CREATE table sw_country (cn_id int(4) auto_increment, cn_name varchar(20) not null, PRIMARY KEY(cn_id), UNIQUE KEY(cn_name)); 
CREATE table sw_picup (pic_id int(10) auto_increment, pic varchar(70) not null, PRIMARY KEY(pic_id));
INSERT into sw_picup values('1','avtar.jpg');
CREATE table sw_profession (w_id int(10) auto_increment, PRIMARY KEY(w_id), profession varchar(40),UNIQUE KEY(profession));
CREATE table sw_workl(wl_id int(10) auto_increment, PRIMARY KEY(wl_id), work_add varchar(80), UNIQUE KEY(work_add));
CREATE table sw_detail (u_id int(5) not null, FOREIGN KEY(u_id) REFERENCES sw_ulogin(u_id), unique key(u_id),sex varchar(1) not null, c_id int(5) not null, FOREIGN KEY(c_id) REFERENCES sw_city(c_id), s_id int(5) not null, FOREIGN KEY(s_id) REFERENCES sw_state(s_id), cn_id int(5) not null, FOREIGN KEY(cn_id) REFERENCES sw_country(cn_id), pic_id int(10) not null, FOREIGN KEY(pic_id) REFERENCES sw_picup(pic_id), bio text, fname varchar(20) not null, lname varchar(20) not null, w_id int(10) not null, FOREIGN KEY(w_id) references sw_profession(w_id), wl_id int(10) not null, FOREIGN KEY(wl_id) references sw_workl(wl_id),dob varchar(12) not null);

CREATE table sw_pid (p_id int(10) not null auto_increment, primary key(p_id), post varchar(200) not null, unique key(post));
CREATE TABLE sw_post (usend_id int(5) not null, foreign key(usend_id) references sw_ulogin(u_id), urev_id int(5) not null, foreign key(urev_id) references sw_ulogin(u_id), pid int(10) not null, foreign key(pid) references sw_pid(p_id), d_ate date, t_ime time);
CREATE TABLE sw_connection (u1id int(5) not null,u2id int(5) not null, Primary key(u1id,u2id), foreign key(u1id) references sw_ulogin(u_id), foreign key(u2id) references sw_ulogin(u_id),bool int(1) not null);

CREATE TABLE sw_online (u_id int(5) not null, foreign key(u_id) references sw_ulogin(u_id), unique key(u_id),d_ate date,t_ime time);

--CREATE TABLE sw_mid (m_id int(10) not null auto_increment, primary key(m_id), message varchar(200) not null);
CREATE TABLE sw_message (usend int(5) not null, foreign key(usend) references sw_ulogin(u_id), urev_id int(5) not null, foreign key(urev_id) references sw_ulogin(u_id), message longtext not null,d_ate date, t_ime time);

CREATE TABLE sw_pcategory (ct_id int(3) not null auto_increment,primary key(ct_id),ct_name varchar(25));
CREATE TABLE sw_paged (page_id int(5) not null auto_increment, primary key(page_id), name varchar(50) not null, ct_id int(3) not null, foreign key(ct_id) references sw_pcategory(ct_id),description longtext,pic_id int(10) not null,foreign key(pic_id) references sw_picup(pic_id));
CREATE TABLE sw_page (page_id int(5) not null, foreign key(page_id) references sw_paged(page_id),u_id int(5) not null, foreign key(u_id) references sw_ulogin(u_id));
CREATE TABLE sw_ppost (p_id int(10) not null,foreign key(p_id) references sw_pid(p_id), page_id int(5) not null,foreign key(page_id) references sw_paged(page_id),u_id int(5) not null,foreign key(u_id) references sw_ulogin(u_id),primary key(p_id,page_id,u_id),d_ate date,t_ime time);

CREATE TABLE sw_ftype (ft_id int(2) not null auto_increment,primary key(ft_id), ft_name varchar(20) not null);
insert into sw_ftype values('1','image');
CREATE TABLE sw_upload (f_id int(10) not null auto_increment,primary key(f_id), fname varchar(30),ftype int(2) not null,foreign key(ftype) references sw_ftype(ft_id),p_ath varchar(50) not null,unique key(p_ath),d_ate date, t_ime time,u_id int(5) not null,foreign key(u_id) references sw_ulogin(u_id));

CREATE table sw_group (g_id int(10) not null auto_increment, primary key(g_id), gp_name varchar(12) not null, ct_id int(10) not null, foreign key(ct_id) references sw_pcategory(ct_id),descr longtext, pic_id int(10) not null,foreign key(pic_id) references sw_picup(pic_id),on_id int(5) not null,foreign key(on_id) references sw_ulogin(u_id),d_ate date not null,t_ime time not null);
CREATE table sw_gjoin (g_id int(10) not null,foreign key(g_id) references sw_group(g_id),u_id int(5) not null,foreign key(u_id) references sw_ulogin(u_id),primary key(g_id,u_id),d_ate date not null,t_time time not null);

CREATE TABLE sw_gpost (g_id int(10) not null, foreign key(g_id) references sw_group(g_id),p_id int(10) not null,foreign key(p_id) references sw_pid(p_id),u_id int(5) not null,foreign key(u_id) references sw_ulogin(u_id),d_ate date not null,t_ime time not null);