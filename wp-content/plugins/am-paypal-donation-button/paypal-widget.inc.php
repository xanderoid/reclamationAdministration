<?php
class am_paypal_donation_button_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'am_paypal_donation_button',
			__( 'AM PayPal donation button' ),
			array( 'description' => __( 'AM PayPal donation button' ) )
		);
	}

	function form( $instance ) {
		if ( $instance ) {
			$am_paypalEmail = esc_attr( $instance['am_paypalEmail'] );
			$am_paypalPurpose = esc_attr( $instance['am_paypalPurpose'] );
			$am_paypalButtonCountryLanguage = esc_attr( $instance['am_paypalButtonCountryLanguage'] );
			$am_paypalButtonOptionCurrency = esc_attr( $instance['am_paypalButtonOptionCurrency'] );
			$am_paypalReference = esc_attr( $instance['am_paypalReference'] );
			$am_paypalButtonImg = esc_attr( $instance['am_paypalButtonImg'] );	
			$am_paypalReturnPage = esc_attr( $instance['am_paypalReturnPage'] );		
		}
		else {
			$am_paypalEmail ="";
			$am_paypalPurpose = "";
			$am_paypalButtonCountryLanguage = "en_US";
			$am_paypalButtonOptionCurrency = "USD";
			$am_paypalReference = "";
			$am_paypalButtonImg = "btn_donate_LG.gif";
			$am_paypalReturnPage = "http://".$_SERVER['HTTP_HOST']."/";
		}
?>
		<p>
		<label for="<?php echo $this->get_field_id( 'am_paypalEmail' ); ?>"><?php _e( 'PayPal ID (Email):' ); ?></label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'am_paypalEmail' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalEmail' ); ?>" value="<?php echo $am_paypalEmail;?>"/> 
        <label for="<?php echo $this->get_field_id( 'am_paypalPurpose' ); ?>"><?php _e( 'Purpose:' ); ?></label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'am_paypalPurpose' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalPurpose' ); ?>" value="<?php echo $am_paypalPurpose;?>" /> 
        <label for="<?php echo $this->get_field_id( 'am_paypalReference' ); ?>"><?php _e( 'Reference:' ); ?></label> 
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'am_paypalReference' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalReference' ); ?>" value="<?php echo $am_paypalReference;?>" />         
        <label for="<?php echo $this->get_field_id( 'am_paypalButtonCountryLanguage' ); ?>"><?php _e( 'Country and language:' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'am_paypalButtonCountryLanguage' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalButtonCountryLanguage' ); ?>">
        <?php 
		include dirname( __FILE__ ) . "/country_language.inc.php";
		foreach($paypal_country_lang as $key=>$value){
		if ($am_paypalButtonCountryLanguage==$key)
		echo "<option value=\"$key\" selected=\"selected\">$value</option>";
		else
		echo "<option value=\"$key\">$value</option>";
		}
		?>
        </select>
        <label for="<?php echo $this->get_field_id( 'am_paypalButtonOptionCurrency' ); ?>"><?php _e( 'Currency:' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'am_paypalButtonOptionCurrency' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalButtonOptionCurrency' ); ?>">
        <?php 
		include dirname( __FILE__ ) . "/currency.inc.php";
		foreach($paypal_currency as $key=>$value){
			if ($am_paypalButtonOptionCurrency==$key)
		echo "<option value=\"$key\" selected=\"selected\">$value</option>";
		else
		echo "<option value=\"$key\">$value</option>";
		}
		?>
        </select>
        <div>
        <?php 			
			$am_paypa_selcted_lang_parts = split("_", $am_paypalButtonCountryLanguage);
			$am_paypa_selcted_lang = $am_paypa_selcted_lang_parts[1];			
			if ($am_paypa_selcted_lang_parts[0] == "en")
			$am_paypalButtonCountryLanguage = "en_US";
			elseif($am_paypa_selcted_lang_parts[0] != strtolower($am_paypa_selcted_lang_parts[1]))
			$am_paypalButtonCountryLanguage = $am_paypa_selcted_lang_parts[0]."_".strtoupper($am_paypa_selcted_lang_parts[0])."/".$am_paypa_selcted_lang_parts[1];
			?>
        <label for="<?php echo $this->get_field_id( 'am_paypalButtonImg' ); ?>"><?php _e( 'Donation Button:' ); ?></label>
        <ul>
        <li>
        <input type="radio" style="float:left;margin-right:10px" id="<?php echo $this->get_field_id( 'am_paypalButtonImgSM' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalButtonImg' ); ?>" value="btn_donate_SM.gif" <?php echo($am_paypalButtonImg=="btn_donate_SM.gif")?"checked":"";?>/>
        	<img src="https://www.paypalobjects.com/<?php echo $am_paypalButtonCountryLanguage;?>/i/btn/btn_donate_SM.gif"/>
        </li>
        <li>
        <input type="radio" style="float:left;margin-right:10px" id="<?php echo $this->get_field_id( 'am_paypalButtonImgLG' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalButtonImg' ); ?>" value="btn_donate_LG.gif" <?php echo($am_paypalButtonImg=="btn_donate_LG.gif")?"checked":"";?>/>
        	<img src="https://www.paypalobjects.com/<?php echo $am_paypalButtonCountryLanguage;?>/i/btn/btn_donate_LG.gif"/>
        </li>
        <li>
        <input type="radio"  style="float:left;margin-right:10px" id="<?php echo $this->get_field_id( 'am_paypalButtonImgCC' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalButtonImg' ); ?>" value="btn_donateCC_LG.gif" <?php echo($am_paypalButtonImg=="btn_donateCC_LG.gif")?"checked":"";?>/>
        	<img src="https://www.paypalobjects.com/<?php echo $am_paypalButtonCountryLanguage;?>/i/btn/btn_donateCC_LG.gif"/>   
         </li>
         <li>
         <label for="<?php echo $this->get_field_id( 'am_paypalReturnPage' ); ?>"><?php _e( 'Return page after donation is done:' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'am_paypalReturnPage' ); ?>" name="<?php echo $this->get_field_name( 'am_paypalReturnPage' ); ?>" value="<?php echo $am_paypalReturnPage;?>" />
         </li>
         </ul>     
         </div>
        </p>

<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance['am_paypalEmail'] = strip_tags( $new_instance['am_paypalEmail'] );
		$instance['am_paypalPurpose'] = strip_tags( $new_instance['am_paypalPurpose'] );
		$instance['am_paypalButtonCountryLanguage'] = strip_tags( $new_instance['am_paypalButtonCountryLanguage'] );
		$instance['am_paypalButtonOptionCurrency'] = strip_tags( $new_instance['am_paypalButtonOptionCurrency'] );
		$instance['am_paypalReference'] = strip_tags( $new_instance['am_paypalReference'] );
		$instance['am_paypalButtonImg'] = strip_tags( $new_instance['am_paypalButtonImg'] );
		$instance['am_paypalReturnPage'] = strip_tags( $new_instance['am_paypalReturnPage'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		$am_paypa_selcted_lang = "GB";
		if ( ! empty( $instance['am_paypalEmail'] ) ) {
			$am_paypalEmail = esc_html( $instance['am_paypalEmail'] );
		}
			if ( ! empty( $instance['am_paypalPurpose'] ) ) {
			$am_paypalPurpose = esc_html( $instance['am_paypalPurpose'] );			
		}
			if ( ! empty( $instance['am_paypalButtonCountryLanguage'] ) ) {
			$am_paypalButtonCountryLanguage = esc_html( $instance['am_paypalButtonCountryLanguage'] );	
			$am_paypa_selcted_lang_parts = split("_", $am_paypalButtonCountryLanguage);
			$am_paypa_selcted_lang = $am_paypa_selcted_lang_parts[1];
			
			if ($am_paypa_selcted_lang_parts[0] == "en")
			$am_paypalButtonCountryLanguage = "en_US";
			elseif($am_paypa_selcted_lang_parts[0] != strtolower($am_paypa_selcted_lang_parts[1]))
			$am_paypalButtonCountryLanguage = $am_paypa_selcted_lang_parts[0]."_".strtoupper($am_paypa_selcted_lang_parts[0])."/".$am_paypa_selcted_lang_parts[1];
		}
		if ( ! empty( $instance['am_paypalButtonOptionCurrency'] ) ) {
			$am_paypalButtonOptionCurrency = esc_html( $instance['am_paypalButtonOptionCurrency'] );			
		}		
		
		if ( ! empty( $instance['am_paypalReference'] ) ) {
			$am_paypalReference = esc_html( $instance['am_paypalReference'] );			
		}	

		if ( ! empty( $instance['am_paypalButtonImg'] ) ) {
			$am_paypalButtonImg = esc_html( $instance['am_paypalButtonImg'] );			
		}		

		if ( ! empty( $instance['am_paypalReturnPage'] ) ) {
			$am_paypalReturnPage = esc_html( $instance['am_paypalReturnPage'] );			
		}	
?>

<div><center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="<?php echo (isset($am_paypalEmail))?$am_paypalEmail:"";?>">
<input type="hidden" name="lc" value="<?php echo (isset($am_paypa_selcted_lang))?$am_paypa_selcted_lang:"";?>">
<input type="hidden" name="item_name" value="<?php echo (isset($am_paypalPurpose))?$am_paypalPurpose:"";?>">
<?php if (isset($am_paypalReference) and trim($am_paypalReference)!=""){ ?>
<input type="hidden" name="item_number" value="<?php echo $am_paypalReference;?>">
<?php };
if (isset($am_paypalReturnPage) and trim($am_paypalReturnPage)!=""){ ?>
<input type="hidden" name="return" value="<?php echo $am_paypalReturnPage;?>">
<?php };?>    
<input type="hidden" name="currency_code" value="<?php echo $am_paypalButtonOptionCurrency;?>">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/<?php echo $am_paypalButtonCountryLanguage;?>/i/btn/<?php echo $am_paypalButtonImg;?>" border="0" name="submit" alt="PayPal" style="height:auto;background:#fff;border:0px">
<img width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt=""></img>
</form>
</center>
</div>

<?php
}
}

function am_register_paypal_donation_button_widget() {
	register_widget( 'am_paypal_donation_button_Widget' );
}
add_action( 'widgets_init', 'am_register_paypal_donation_button_widget' );
?>