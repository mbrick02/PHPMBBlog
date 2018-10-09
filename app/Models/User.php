<?php

namespace app\Models;

class User extends DB {
// id, username, email, fname, lname, password,
//    remember_token, created_at, updated_at
/*
remember_token
No. It's not supposed to be used to authenticate.
It's used by the framework to help against Remember Me cookie hijacking.
The value is refreshed upon login and logout.
If a cookie is hijacked by a malicious person,
logging out makes the hijacked cookie useless since it doesn't match anymore.
*/

}
