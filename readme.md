**Caution:** This repository will be changing name shortly to "*licentia*", so it fits in with my normal project codename convention.
# CodeIgniter Access Control List
This is yet another ACL implementation for [CodeIgniter](http://ellislab.com/codeigniter). More specifically this is a role-based access control list for CodeIgniter.

It follows this basic model:

	   +----+
	   |user|+- - - - - - - -+         +---------+
	   +----+                -    a --+|user_role|+--
	     +                   -         +---------+
	     |                   -
	     |                   -
	     +                   +         +---------+
	   +----+      b      +----+  b --+|role_perm|+--
	   |role|+-----------+|perm|       +---------+
	   +----+             +----+
	
	
	   Key
	   ========================
	   ----+  one-to-many
	   -----  one-to-one
	   - - -  indirect relation

This can also be described using some basic set theory:

	u  = user
	r  = role
	p  = perm
	ua = user assignment
	pa = perm assignment
	
	ua ⊆ u × r
	pa ⊆ p × r

This implementation uses numerical values (2^n) for the permissions (don't worry the database schema still stores wordy versions of each permission), and bitwise operations to check that a user has the needed permissions to perform a given action.

The system also does not account for users having permissions directly but instead forces a user to be assigned at least one role.

At this current time there are no plans to allow users to have roles independent of roles, however there are plans to have role hierarchy using the following logic:

	rh = role hierarchy
	
	rh ⊆ r × r
	
## Usage
To use this system you will need to ensure that you have at least the minimum required fields in your database schema, and you will need to add both the ci_acl model, and ci_acl library to your CodeIgniter setup.

### Minimum Database Requirements
The table names can be changed within the `application/config/acl.php` file.

	   +-----------+
	   |user       |
	   |-----------|
	   |user_id    <--+
	   |name       |  |
	   |email      |  |
	   |password   |  |
	   +-----------+  |
	                  |
	   +-----------+  |
	   |user_role  |  |
	   |-----------|  |
	   |user_id    +--+
	+--+role_id    |
	|  +-----------+
	|
	|  +-----------+                           +-----------+
	|  |role       |       +-----------+       |perm       |
	|  |-----------|       |role_perm  |       |-----------|
	+-->role_id    <---+   |-----------|   +--->perm_id    |
	   |name       |   +---+role_id    |   |   |name       |
	   |description|       |perm_id    +---+   |value      |
	   +-----------+       +-----------+       +-----------+

The schema for these tables as defined above can be found in `acl_schema.sql`, this contains extra information such as field types, and primary keys.

## License
All code in this project is subject to the terms of the [Mozilla Public License, v. 2.0](http://mozilla.org/MPL/2.0/) except where otherwise noted.