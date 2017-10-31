<table> 
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="customer_email"><?php _e( 'Customer email', 'maid-booking' ); ?></label>
        </th>
        <td>
            <input type="text" id="customer_email" name="customer_email" value="<?php echo @get_post_meta($post->ID, 'customer_email', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="meta_a">Meta B</label>
        </th>
        <td>
            <input type="text" id="meta_b" name="meta_b" value="<?php echo @get_post_meta($post->ID, 'meta_b', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="meta_a">Meta C</label>
        </th>
        <td>
            <input type="text" id="meta_c" name="meta_c" value="<?php echo @get_post_meta($post->ID, 'meta_c', true); ?>" />
        </td>
    </tr>                
</table>