<?php
if (!defined("_am_paypal_button_")){exit();};

$am_paypal_opts =  get_option('am_paypal_donation_button');
		if ( ! empty( $am_paypal_opts['am_paypalEmail'] ) ) {
			$am_paypalEmail = esc_html( $am_paypal_opts['am_paypalEmail'] );
		}
			if ( ! empty( $am_paypal_opts['am_paypalPurpose'] ) ) {
			$am_paypalPurpose = esc_html( $am_paypal_opts['am_paypalPurpose'] );			
		}
			if ( ! empty( $am_paypal_opts['am_paypalButtonCountryLanguage'] ) ) {
			$am_paypalButtonCountryLanguage = esc_html( $am_paypal_opts['am_paypalButtonCountryLanguage'] );	
			$am_paypa_selcted_lang_parts = split("_", $am_paypalButtonCountryLanguage);
			$am_paypa_selcted_lang = $am_paypa_selcted_lang_parts[1];
			
			if ($am_paypa_selcted_lang_parts[0] == "en")
			$am_paypalButtonCountryLanguage = "en_US";
			elseif($am_paypa_selcted_lang_parts[0] != strtolower($am_paypa_selcted_lang_parts[1]))
			$am_paypalButtonCountryLanguage = $am_paypa_selcted_lang_parts[0]."_".strtoupper($am_paypa_selcted_lang_parts[0])."/".$am_paypa_selcted_lang_parts[1];
		}
		if ( ! empty( $am_paypal_opts['am_paypalButtonOptionCurrency'] ) ) {
			$am_paypalButtonOptionCurrency = esc_html( $am_paypal_opts['am_paypalButtonOptionCurrency'] );			
		}		
		
		if ( ! empty( $am_paypal_opts['am_paypalReference'] ) ) {
			$am_paypalReference = esc_html( $am_paypal_opts['am_paypalReference'] );			
		}	

		if ( ! empty( $am_paypal_opts['am_paypalButtonImg'] ) ) {
			$am_paypalButtonImg = esc_html( $am_paypal_opts['am_paypalButtonImg'] );			
		}		

		if ( ! empty( $am_paypal_opts['am_paypalReturnPage'] ) ) {
			$am_paypalReturnPage = esc_html( $am_paypal_opts['am_paypalReturnPage'] );			
		}	

?>
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