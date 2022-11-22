Create table customer
	(first_name  varchar(20),
	 last_name   varchar(20),
	 pin	     int,
	 user_name   varchar(20),
	 street	     varchar(25),
	 city	     varchar(20),
	 stat 	     varchar(20),
	 zip	     varchar(5),
	 primary key (user_name)
);

Create table payment_info
	(card_num	bigint,
	ptype	    varchar(15),
	exp_date	varchar(6),
	user_name	varchar(20),
	primary key (card_num),
	foreign key (user_name) references customer(user_name)
		on delete cascade
);

Create table book
	(isbn		varchar(30),
	title		varchar(100),
	author		varchar(50),
	publisher	varchar(50),
	category	varchar(20),
	cost 		float,
	primary key (isbn)
);

Create table book_order
	(order_num	int,
	total		float,
	isbn		varchar(30),
	user_name	varchar(20),
	primary key (order_num),
	foreign key (isbn) references book(isbn),
	foreign key (user_name) references customer(user_name)
);

Create table review
	(id		int,
	the_review	varchar(500),
	isbn		varchar(500),
	primary key (id),
	foreign key (isbn) references book(isbn)
		on delete cascade
);
	