**Example usage (e.g. in theme functions.php file or other plugin)**

1. Add a new Email post, add a title (email subject), some content (email body) and a trigger (when are you going to trigger this email? (e.g. user-created)
2. Add a code snippet including the required hook for firing the email (you will need access to the user ID/object you wish to send to)

In this example we will send a custom email with the trigger (tag) "user-created" every time a new user registers to the site.
We can use the trigger slug or ID here. Similarly the user object or ID can be used:

```add_action( 'user_register', function ( $user_id ) {  
    pce_send_emails( 'user-created', $user_id );  
});```

***Default placeholders for email subject and body (can be overidden by supplying own array as third parameter to pce_send_emails)***  
'{{user.first_name}}' => $first_name,  
'{{user.last_name}}'  => $last_name,  
'{{user.email}}'      => $user->user_email  