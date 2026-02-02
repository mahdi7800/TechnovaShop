<?php
add_action('wp_ajax_tns_compare', 'tns_compare');
function tns_compare() {
    if ( !is_user_logged_in() ) {
        wp_send_json( [ 'error' => true, 'message' => 'لطفا اول وارد شوید!!' ], 403 );
    }
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'] ) ) {
        die( 'access denied' );
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'tns_compare';
    $product_id = intval( $_POST['product_id'] );
    $user_id = get_current_user_id();
    $product_name = get_the_title( $product_id );
    $thumbnail = get_the_post_thumbnail_url($product_id);
    $permalink = get_permalink( $product_id );

    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$table_name} WHERE u_id = %d AND p_id = %d",
        $user_id, $product_id
    ));
    if ( $exists ) {

        $deleted = $wpdb->delete(
            $table_name,
            ['u_id' => $user_id, 'p_id' => $product_id],
            ['%d', '%d']
        );
        if ( $deleted ) {
            wp_send_json(['success' => true, 'message' => 'محصول از لیست علاقه‌مندی‌ها حذف شد.'], 200);
        } else {
            wp_send_json(['error' => true, 'message' => 'خطا در حذف اطلاعات!'], 500);
        }
    }else {
        $data = [
            'p_id'        => $product_id,
            'u_id'        => $user_id,
            'p_title'     => $product_name,
            'p_thumbnail' => $thumbnail,
            'p_permalink' => $permalink
        ];
        $format = ['%d', '%d', '%s', '%s', '%s'];

        $stmt = $wpdb->insert($table_name,$data , $format);
        if ($stmt){
            wp_send_json(['success'=>true,'message'=>'محصول به لیست علاقه مندی ها اضافه شد!'],200);
        }else{
            wp_send_json(['error' => true, 'message' => 'خطا در درج داده است! '], 403);
        }
    }


}
function tns_user_bookmark_product_compare($user_id , $product_id): bool {
    global $wpdb;
    $table = $wpdb-> prefix . 'tns_compare' ;
    $stmt  = $wpdb->get_row($wpdb->prepare("SELECT u_id , p_id FROM {$table} WHERE u_id='%d' AND p_id='%d'",$user_id,$product_id));
    if ($stmt){
        return true;
    }else{
        return false;
    }
}