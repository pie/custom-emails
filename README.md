**Example usage (e.g. in theme functions.php file or other plugin)**

1. Add a new Email post, add a title (email subject), some content (email body) and a trigger (when are you going to trigger this email? (e.g. user-created)
2. Add a code snippet including the required hook for firing the email (you will need access to the user ID/object you wish to send to)

In this example we will send a custom email with the trigger "user-created" every time a new user registers to the site:

```add_action( 'user_register', function ( $user_id ) {
    pce_send_emails( 'user-created', $user_id );
});```