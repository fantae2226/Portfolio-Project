-- I tried, your friendliest of neighbourhood MacDonalds! BOTTA BLICK BLAM BOW
-- USER TABLE CREATION

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- TEST USER CREDS
INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'porcelain_power', 'peepeepoopoo', `Porcelainia@gmail.com`);






--LIKES TABLE CREATION
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stack_id` int(11) NOT NULL,
  `likes_count` int(11),
  PRIMARY KEY (`like_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`stack_id`) REFERENCES `stacks`(`stack_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- INDEXES FOR `likes` TABLE
ALTER TABLE `likes`
  ADD UNIQUE KEY `IX_COMP` (`user_id`,`stack_id`);





-- STACKS TABLE CREATION
CREATE TABLE `stacks` (
    `stack_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `title` varchar(100) NOT NULL,
    `body_text` text() NOT NULL,
    `status` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL,
    PRIMARY KEY ('stack_id')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;





-- COMMENTS TABLE CREATION
CREATE TABLE `comments` (
    `user_id` int(11) NOT NULL,
    `stack_id` int(11) NOT NULL,
    `body_text` text() NOT NULL,
    `status` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL,
    PRIMARY KEY ('user_id')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;





-- FOLLOWS TABLE CREATION
CREATE TABLE `follows` (
    `user_id` int(11) NOT NULL,
    `following_user_id` int(11) NOT NULL,
    `followed_user_id` int(11) NOT NULL,
    `created_at` timestamp NOT NULL,
    PRIMARY KEY ('user_id')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;