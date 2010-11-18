CREATE TABLE attendee (user_id BIGINT, event_id BIGINT, PRIMARY KEY(user_id, event_id)) ENGINE = INNODB;
CREATE TABLE conference (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX conference_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE content (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE country (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, slug VARCHAR(255), UNIQUE INDEX country_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE event (id BIGINT AUTO_INCREMENT, conference_id BIGINT NOT NULL, location_id BIGINT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, hashtag VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, postcode VARCHAR(8) NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX event_sluggable_idx (slug), INDEX conference_id_idx (conference_id), INDEX location_id_idx (location_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE favouriter (user_id BIGINT, event_id BIGINT, PRIMARY KEY(user_id, event_id)) ENGINE = INNODB;
CREATE TABLE location (id BIGINT AUTO_INCREMENT, country_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255), UNIQUE INDEX location_sluggable_idx (slug), INDEX country_id_idx (country_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE organiser (user_id BIGINT, event_id BIGINT, PRIMARY KEY(user_id, event_id)) ENGINE = INNODB;
CREATE TABLE presentation (id BIGINT AUTO_INCREMENT, event_id BIGINT, content_id BIGINT, UNIQUE INDEX event_id_content_id_idx (event_id, content_id), INDEX event_id_idx (event_id), INDEX content_id_idx (content_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE presentation_user (presentation_id BIGINT, user_id BIGINT, PRIMARY KEY(presentation_id, user_id)) ENGINE = INNODB;
CREATE TABLE speaker (user_id BIGINT, event_id BIGINT, PRIMARY KEY(user_id, event_id)) ENGINE = INNODB;
CREATE TABLE watcher (user_id BIGINT, event_id BIGINT, PRIMARY KEY(user_id, event_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_profile (id BIGINT AUTO_INCREMENT, name VARCHAR(255), description VARCHAR(255), website VARCHAR(255), image VARCHAR(255), icon VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE attendee ADD CONSTRAINT attendee_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE attendee ADD CONSTRAINT attendee_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE event ADD CONSTRAINT event_location_id_location_id FOREIGN KEY (location_id) REFERENCES location(id);
ALTER TABLE event ADD CONSTRAINT event_conference_id_conference_id FOREIGN KEY (conference_id) REFERENCES conference(id);
ALTER TABLE favouriter ADD CONSTRAINT favouriter_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE favouriter ADD CONSTRAINT favouriter_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE location ADD CONSTRAINT location_country_id_country_id FOREIGN KEY (country_id) REFERENCES country(id);
ALTER TABLE organiser ADD CONSTRAINT organiser_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE organiser ADD CONSTRAINT organiser_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE presentation ADD CONSTRAINT presentation_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE presentation ADD CONSTRAINT presentation_content_id_content_id FOREIGN KEY (content_id) REFERENCES content(id);
ALTER TABLE presentation_user ADD CONSTRAINT presentation_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE presentation_user ADD CONSTRAINT presentation_user_presentation_id_presentation_id FOREIGN KEY (presentation_id) REFERENCES presentation(id);
ALTER TABLE speaker ADD CONSTRAINT speaker_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE speaker ADD CONSTRAINT speaker_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE watcher ADD CONSTRAINT watcher_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE watcher ADD CONSTRAINT watcher_event_id_event_id FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
