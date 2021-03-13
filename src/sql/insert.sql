insert into m_customers values('ooyamada','ooyamada' ,'大山田徹', '東京都豊島区1-2-3', '03-222-3333', 'ooyamada@example.com', 0, '2008-10-18');
insert into m_customers values('ooie', 'ooie','大家雅人', '東京都中野区1-2-3', '03-111-2222', 'ooie@example.com', 0, '2008-10-18');
insert into m_customers values('tanaka','tanaka', '田中香織', '神奈川県横浜1-2-3', '01-222-3333', 'tanaka@example.com', 0, '2008-10-18');

insert into m_items values(1001, 'YAMAHAトランペット', 200000, 1, 'EG024.jpg', '音色が明るく、芯のある音がでます。', 0, '2008-10-18');
insert into m_items values(1002, 'SELMERアルトサックス', 150000, 1, 'EG028.jpg', 'なめらかでしっとりした音色を好む方にぴったりです。',0, '2008-10-18');
insert into m_items values(1003, 'YAMAHAトロンボーン', 132000, 1, 'EG026.jpg','初心者に優しいトロンボーンです！', 0, '2008-10-18');
insert into m_items values(1004, 'リコーダー', 35000, 1, 'EG040.jpg', '童心にかえってドナドナを吹いてみませんか？', 0,'2008-10-18');
insert into m_items values(2001, 'オリエンテ製コントラバス', 300000, 2, 'EG007.jpg','日本製ですので、湿気に強くメンテナンスが楽です。', 0, '2008-10-18');
insert into m_items values(2002, '鈴木バイオリン製チェロ', 735000, 2, 'EG001.jpg','高いだけあっていい音がでますよ！！', 0, '2008-10-18');
insert into m_items values(2003, 'Ibanezベース', 735000, 2, 'EG017.jpg','スタジオミュージシャンの中でも愛好家が多いベースです。', 0, '2008-10-18');
insert into m_items values(2004, 'Gibsonレスポール', 350000, 2, 'EG016.jpg','この音の太さ！ロック系にはたまりません！', 0, '2008-10-18');
insert into m_items values(2005, 'Ibanezギター', 150000, 2, 'EG013.jpg','初心者から利用可能な、幅広く使えるギターです。', 0, '2008-10-18');
insert into m_items values(3001, 'TAMAドラムセット', 100000, 3, 'EG048.jpg','一般的に聴きなじみのあるサウンドです。よく鳴ります。', 0, '2008-10-18');
insert into m_items values(3002, 'キューバ製コンガ', 215000, 3, 'EG050.jpg','ラテンの血が騒ぎます！', 0, '2008-10-18');
insert into m_items values(3003, 'タンバリン皮付き', 8000, 3, 'EG053.jpg','ポーンとよく飛ぶ音です。', 0, '2008-10-18');
insert into m_items values(3004, 'タンバリン皮無し', 10000, 3, 'EG054.jpg','ノスタルジックな音がでます。', 0, '2008-10-18');

insert into d_purchase(order_id,customer_code,purchase_date,total_price) values(1,'ooie','2009-3-18',630000);
insert into d_purchase(order_id,customer_code,purchase_date,total_price) values(2,'tanaka','2009-3-20',29400);
insert into d_purchase(order_id,customer_code,purchase_date,total_price) values(3,'ooie','2009-4-10',348600);

insert into d_purchase_detail values(1,1,2001,315000,1);
insert into d_purchase_detail values(2,1,1001,210000,1);
insert into d_purchase_detail values(3,1,3001,105000,1);
insert into d_purchase_detail values(4,2,3003,8400,1);
insert into d_purchase_detail values(5,2,3004,10500,2);
insert into d_purchase_detail values(6,3,1001,210000,1);
insert into d_purchase_detail values(7,3,1003,138600,1);
