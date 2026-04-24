<?php
/**
 * Main plugin class for Law Firm Contact Plugin
 */

class Law_Firm_Contact {

    /**
     * Initialize the plugin
     */
    public function init() {
        $this->load_textdomain();
        $this->register_hooks();
        $this->register_shortcodes();
    }

    /**
     * Load plugin textdomain
     */
    private function load_textdomain() {
        load_plugin_textdomain(
            'law-firm-contact',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/languages/'
        );
    }

    /**
     * Register hooks
     */
    private function register_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_ajax_law_firm_contact_submit', array( $this, 'handle_form_submission' ) );
        add_action( 'wp_ajax_nopriv_law_firm_contact_submit', array( $this, 'handle_form_submission' ) );
    }

    /**
     * Register shortcodes
     */
    private function register_shortcodes() {
        add_shortcode( 'law_firm_contact_form', array( $this, 'contact_form_shortcode' ) );
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            'law-firm-contact-js',
            LAW_FIRM_CONTACT_PLUGIN_URL . 'assets/js/contact-form.js',
            array( 'jquery' ),
            LAW_FIRM_CONTACT_VERSION,
            true
        );

        wp_enqueue_style(
            'law-firm-contact-css',
            LAW_FIRM_CONTACT_PLUGIN_URL . 'assets/css/contact-form.css',
            array(),
            LAW_FIRM_CONTACT_VERSION
        );

        wp_localize_script( 'law-firm-contact-js', 'lawFirmContact', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'law_firm_contact_nonce' ),
        ) );
    }

    /**
     * Contact form shortcode
     */
    public function contact_form_shortcode( $atts ) {
        ob_start();
        ?>
        <form id="law-firm-contact-form" method="post">
            <div class="form-group">
                <label for="contact-name"><?php _e( 'Name', 'law-firm-contact' ); ?></label>
                <input type="text" id="contact-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="contact-email"><?php _e( 'Email', 'law-firm-contact' ); ?></label>
                <input type="email" id="contact-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="contact-phone"><?php _e( 'Phone', 'law-firm-contact' ); ?></label>
                <input type="tel" id="contact-phone" name="phone">
            </div>
            <div class="form-group">
                <label for="contact-message"><?php _e( 'Message', 'law-firm-contact' ); ?></label>
                <textarea id="contact-message" name="message" required></textarea>
            </div>
            <button type="submit"><?php _e( 'Send Message', 'law-firm-contact' ); ?></button>
        </form>
        <?php
        return ob_get_clean();
    }

    /**
     * Handle form submission
     */
    public function handle_form_submission() {
        // Verify nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'law_firm_contact_nonce' ) ) {
            wp_die( 'Security check failed' );
        }

        // Sanitize and validate input
        $name    = sanitize_text_field( $_POST['name'] );
        $email   = sanitize_email( $_POST['email'] );
        $phone   = sanitize_text_field( $_POST['phone'] );
        $message = sanitize_textarea_field( $_POST['message'] );

        // Basic validation
        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            wp_send_json_error( 'All required fields must be filled.' );
        }

        if ( ! is_email( $email ) ) {
            wp_send_json_error( 'Invalid email address.' );
        }

        // Send email
        $to      = get_option( 'admin_email' );
        $subject = 'New Contact Form Submission from ' . $name;
        $body    = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        if ( wp_mail( $to, $subject, $body ) ) {
            wp_send_json_success( 'Message sent successfully!' );
        } else {
            wp_send_json_error( 'Failed to send message. Please try again.' );
        }
    }
}
