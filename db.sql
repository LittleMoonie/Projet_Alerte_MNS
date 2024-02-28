CREATE TABLE users(
   user_id INT AUTO_INCREMENT,
   user_lastname VARCHAR(50),
   user_firstname VARCHAR(50),
   user_mail VARCHAR(100),
   user_password VARCHAR(100),
   user_picture VARCHAR(254),
   PRIMARY KEY(user_id)
);

CREATE TABLE callinfo(
   call_id INT AUTO_INCREMENT,
   call_start DATETIME,
   call_duration TIME,
   call_type VARCHAR(50),
   PRIMARY KEY(call_id)
);

CREATE TABLE event_calendar(
   event_id INT AUTO_INCREMENT,
   event_title VARCHAR(50),
   event_description VARCHAR(50),
   event_start DATETIME,
   event_end DATETIME,
   PRIMARY KEY(event_id)
);

CREATE TABLE user_preference(
   preference_id INT AUTO_INCREMENT,
   preference_type VARCHAR(50),
   preference_content VARCHAR(200),
   user_id INT NOT NULL,
   PRIMARY KEY(preference_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id)
);

CREATE TABLE moderation_queue(
   queue_id INT AUTO_INCREMENT,
   queue_reported_content_id BIGINT,
   queue_reported_user_id BIGINT,
   queue_report_reason VARCHAR(100),
   queue_report_timestamp DATETIME,
   queue_status VARCHAR(50),
   user_id INT NOT NULL,
   PRIMARY KEY(queue_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id)
);

CREATE TABLE moderation_action(
   action_id INT AUTO_INCREMENT,
   action_moderator_user_id BIGINT,
   action_type VARCHAR(50),
   action_timestamp DATETIME,
   action_notes VARCHAR(400),
   queue_id INT NOT NULL,
   PRIMARY KEY(action_id),
   FOREIGN KEY(queue_id) REFERENCES table_moderation_queue(queue_id)
);

CREATE TABLE category(
   category_id INT AUTO_INCREMENT,
   category_name VARCHAR(50),
   category_description VARCHAR(200),
   user_id INT NOT NULL,
   PRIMARY KEY(category_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id)
);

CREATE TABLE audit_log(
   log_id INT AUTO_INCREMENT,
   log_action_type VARCHAR(50),
   log_timestamp DATETIME,
   log_details VARCHAR(200),
   user_id INT NOT NULL,
   PRIMARY KEY(log_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id)
);

CREATE TABLE user_group(
   group_id INT AUTO_INCREMENT,
   group_name VARCHAR(50),
   PRIMARY KEY(group_id)
);

CREATE TABLE permission(
   perm_id INT AUTO_INCREMENT,
   perm_name VARCHAR(50),
   perm_has_perm BOOLEAN,
   PRIMARY KEY(perm_id)
);

CREATE TABLE moderation_type(
   moderation_type_id INT AUTO_INCREMENT,
   moderation_type_name VARCHAR(50),
   PRIMARY KEY(moderation_type_id)
);

CREATE TABLE logs_type(
   logs_type_id INT AUTO_INCREMENT,
   logs_type_name VARCHAR(50),
   PRIMARY KEY(logs_type_id)
);

CREATE TABLE channel(
   channel_id INT AUTO_INCREMENT,
   channel_name VARCHAR(50),
   channel_type VARCHAR(50),
   channel_description VARCHAR(400),
   category_id INT,
   PRIMARY KEY(channel_id),
   FOREIGN KEY(category_id) REFERENCES table_category(category_id)
);

CREATE TABLE message(
   message_id INT AUTO_INCREMENT,
   message_sender_id BIGINT,
   message_content VARCHAR(2000),
   message_timestamp DATETIME,
   message_file_type VARCHAR(50),
   user_id INT NOT NULL,
   channel_id INT NOT NULL,
   PRIMARY KEY(message_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(channel_id) REFERENCES table_channel(channel_id)
);

CREATE TABLE user_see(
   see_id INT AUTO_INCREMENT,
   see_status VARCHAR(50),
   message_id INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(see_id),
   FOREIGN KEY(message_id) REFERENCES table_message(message_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id)
);

CREATE TABLE userXcategory(
   user_id INT,
   category_id INT,
   PRIMARY KEY(user_id, category_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(category_id) REFERENCES table_category(category_id)
);

CREATE TABLE userXcall(
   user_id INT,
   call_id INT,
   PRIMARY KEY(user_id, call_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(call_id) REFERENCES table_call(call_id)
);

CREATE TABLE userXcalendar(
   user_id INT,
   event_id INT,
   PRIMARY KEY(user_id, event_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(event_id) REFERENCES table_event_calendar(event_id)
);

CREATE TABLE userXgroup(
   user_id INT,
   group_id INT,
   PRIMARY KEY(user_id, group_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(group_id) REFERENCES table_user_group(group_id)
);

CREATE TABLE channelXperm(
   channel_id INT,
   perm_id INT,
   PRIMARY KEY(channel_id, perm_id),
   FOREIGN KEY(channel_id) REFERENCES table_channel(channel_id),
   FOREIGN KEY(perm_id) REFERENCES table_permission(perm_id)
);

CREATE TABLE groupXperm(
   group_id INT,
   perm_id INT,
   PRIMARY KEY(group_id, perm_id),
   FOREIGN KEY(group_id) REFERENCES table_user_group(group_id),
   FOREIGN KEY(perm_id) REFERENCES table_permission(perm_id)
);

CREATE TABLE logsXtype(
   log_id INT,
   logs_type_id INT,
   PRIMARY KEY(log_id, logs_type_id),
   FOREIGN KEY(log_id) REFERENCES table_audit_log(log_id),
   FOREIGN KEY(logs_type_id) REFERENCES table_logs_type(logs_type_id)
);

CREATE TABLE moderationXtype(
   action_id INT,
   moderation_type_id INT,
   PRIMARY KEY(action_id, moderation_type_id),
   FOREIGN KEY(action_id) REFERENCES table_moderation_action(action_id),
   FOREIGN KEY(moderation_type_id) REFERENCES table_moderation_type(moderation_type_id)
);

CREATE TABLE pin(
   user_id INT,
   message_id INT,
   PRIMARY KEY(user_id, message_id),
   FOREIGN KEY(user_id) REFERENCES table_user(user_id),
   FOREIGN KEY(message_id) REFERENCES table_message(message_id)
);