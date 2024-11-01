<?php
/**
 * @package syonPolicy
 * @version 1.2
 */
/*
Plugin Name: Syon Easy Privacy Policy And Terms Of Use Plugin
Plugin URI: http://www.syonplugins.com/
Description: A direct and easy to include privacy policy for meeting Google's requirements, related to websites using AdSense is provided by this plugin.
Author: Syonplugins
Version: 1.2
Author URI:
*/

add_action('admin_menu', 'add_syon_menu');

function add_syon_menu() {
    add_menu_page(__('Syon Policy','menu-test'), __('Syon Policy','menu-test'), 'manage_options', 'manage-policy', 'manage_policy' );
   add_submenu_page('manage-policy', __('Syon Terms','menu-test'), __('Syon Terms','syon-terms'), 'manage_options', 'syon-terms', 'manage_syon_terms');
  add_submenu_page('manage-policy', __('Feedback','menu-test'), __('Feedback','feedback-form'), 'manage_options', 'feedback-form', 'feedback_form');

}

//



///


register_activation_hook(__FILE__,'policy_install');
register_deactivation_hook(__FILE__,'policy_uninstall');
function policy_install()
{
	$fname="../wp-content/plugins/".get_policy_dir_name()."/policy.txt";
	$fcontent=get_default_content();
	$f=fopen($fname,"w+");
	$f1=fwrite($f,$fcontent);
	$fname1="../wp-content/plugins/".get_policy_dir_name()."/terms.txt";
	$fcontent1=get_default_terms_content();
	$f12=fopen($fname1,"w+");
	$f11=fwrite($f12,$fcontent1);
	
}

function policy_uninstall()
{
	$fname="../wp-content/plugins/".get_policy_dir_name()."/policy.txt";
	if(file_exists($fname))
	{
		unlink($fname);
	}
	$fname="../wp-content/plugins/".get_policy_dir_name()."/terms.txt";
	if(file_exists($fname))
	{
		unlink($fname);
	}
}

function reset_policy()
{
	$fname="../wp-content/plugins/".get_policy_dir_name()."/policy.txt";
	if(file_exists($fname))
	{
		unlink($fname);
	}
	$fname="../wp-content/plugins/".get_policy_dir_name()."/policy.txt";
	$fcontent=get_default_content();
	$f=fopen($fname,"w+");
	$f1=fwrite($f,$fcontent);
}
function reset_syon_terms()
{
	$fname="../wp-content/plugins/".get_policy_dir_name()."/terms.txt";
	if(file_exists($fname))
	{
		unlink($fname);
	}
	$fname="../wp-content/plugins/".get_policy_dir_name()."/terms.txt";
	$fcontent=get_default_terms_content();
	$f=fopen($fname,"w+");
	$f1=fwrite($f,$fcontent);
}
function get_policy_dir_name()
{
$dirnamestr=plugin_basename(__FILE__);
$dirnamearray=explode("/",$dirnamestr);
$dirname=trim($dirnamearray[0]);
return $dirname;
}

function manage_policy()
{
	if(isset($_POST['action']))
	{
		$action=trim($_POST['action']);
		if($action=="policy")
		{
			$content=reset_policy();
		}
	}

		?>
<div class="syon-wrap">        
    	<h1>Syon Privacy Policy <br /><span>Ver 1.0.0</span></h1>
 <h4>About the Plugin</h4>
   <p>
            A direct and easy to include privacy policy for meeting Google's requirements, related to websites using AdSense is provided by this plugin.Google Privacy Policy Text Privacy Policy [Review] To include the Privacy Policy on your site add <font class="quote_policy">[syonpolicy]</font> to the page or post where you want the privacy policy to appear.
            </p>
    <table cellpadding="2" cellspacing="2" border="0" width="100%" class="syonTable">
  
        
        <tr>
        	<td>
          	<form action="" method="post" >
            <input type="hidden" name="action" value="policy" id="action" />
	        <input type="submit" value="Reset To Default" />
            </form>
            </td>
        </tr>
       <form action="../wp-content/plugins/<?php echo get_policy_dir_name();?>/savedata.php" method="post" target="savingframe">
        <tr>
        <td class="policy_content">
        <h4>Content</h4>
        <p >
        <? the_editor(get_content());?>
        </p>
        </td>
        </tr>
        <tr>
        <td align="right">
        <input type="hidden" name="ctype" id="ctype" value="policy" />
        <input type="submit" value="Update Content" />
        </td>
        </tr>
        </form>
    </table>
    </form>
    </div>
    <iframe name="savingframe" id="savingframe"  width="100%"></iframe>
	<?
}
function manage_syon_terms()
{
	if(isset($_POST['action']))
	{
		$action=trim($_POST['action']);
		if($action=="terms")
		{
			$content=reset_syon_terms();
		}
	}
	
		?>
        <div class="syon-wrap"> 
        <h1>Syon Terms And Conditions <br /><span>Ver 1.0.0</span></h1>
		 <h4>About the Plugin</h4>
             <p>
            A direct and easy to include privacy policy for meeting Google's requirements, related to websites using AdSense is provided by this plugin.Google Privacy Policy Text Privacy Policy [Review] To include the Privacy Policy on your site add <font class="quote_policy">[syonterms]</font> to the page or post where you want the privacy policy to appear.
            </p>
   
   
	<table cellpadding="2" cellspacing="2" border="0" width="100%" class="syonTable">
    	
        
        <tr>
        	<td>
          	<form action="" method="post" >
            <input type="hidden" name="action" value="terms" id="action" />
	        <input type="submit" value="Reset To Default" />
            </form>
            </td>
        </tr>
        <form action="../wp-content/plugins/<?php echo get_policy_dir_name();?>/savedata.php" method="post" target="savingframe">
        <tr>
        <td class="policy_content">
        <h4>Content</h4>
        <p >
        <? the_editor(get_syon_terms());?>
        </p>
        </td>
        </tr>
        <tr>
        <td align="right">
        <input type="hidden" name="ctype" id="ctype" value="terms" />
        <input type="submit" value="Update Content" />
        </td>
        </tr>
        </form>
    </table>
  </div>
    <iframe name="savingframe" id="savingframe"  width="100%"></iframe>
	<?
}
function get_content()
{
	$content=file_get_contents("../wp-content/plugins/".get_policy_dir_name()."/policy.txt");
	return $content;
}
function get_syon_terms()
{
	$content=file_get_contents("../wp-content/plugins/".get_policy_dir_name()."/terms.txt");
	return $content;
}
function get_content1()
{
	$content=file_get_contents("wp-content/plugins/".get_policy_dir_name()."/policy.txt");
	return $content;
}
function get_syon_terms1()
{
	$content=file_get_contents("wp-content/plugins/".get_policy_dir_name()."/terms.txt");
	return $content;
}
function get_default_content()
{
		$str='<p>Privacy Policy for <a href="'.get_bloginfo("url").'" title="'.get_bloginfo("name").'">'.get_bloginfo("name").'</a>.</p>
		<p>We recognize the importance of our visitor\'s privacy and we aim to preserve the Privacy by all means. The information furnished herewith will inform you on the types of personal information we receive and collect when you use (operate) and visit <a href="'.get_bloginfo("url").'" title="'.get_bloginfo("name").'">'.get_bloginfo("name").'</a>, and how we safeguard your information. You can be assured that your personal information is never leaked or sold to the third parties and they are well protected by us.</p>
		<p>
		<strong>Log Files</strong> As with most other websites, we also collect and use the data contained in log files. The information in the log files include your IP (internet protocol) address, your ISP (internet service provider, such as AOL or Shaw Cable), the browser used by you to visit our site (such as Internet Explorer or Firefox), your site visit time and the pages browsed by you throughout our site.
		</p>
		<p>
		<strong>Cookies and Web Beacons</strong> We do use cookies to store information, such as your personal preferences when you visit our site. This could include showing a popup only once during your visit, or the ability to login to some of our key features, such as forums.
		</p>
		<p>
		We also visualize third party advertisements on <a href="'.get_bloginfo("url").'" title="'.get_bloginfo("name").'">'.get_bloginfo("name").'</a> to support our site. Few of these advertisers may use technology such as cookies and web beacons when they advertise on our site that also send these advertisers (such as Google through the Google AdSense program) information including your IP address, your ISP , the browser used by you to visit our site, and in some cases, whether you have installed Flash. Such application is generally applied for geotargeting purposes, e.g., (showing New York real estate ads to someone in New York) or showing certain ads, based on specific visited sites (such as showing cooking ads to someone who frequents cooking sites).
		</p>
		<p>
		<strong>DoubleClick DART cookies</strong> We also may use  DART cookies for ad serving through Google\'s DoubleClick, The DART cookies may also be used by us for ad serving through Google\'s DoubleClick, which places a cookie on your computer when you are browsing the web and visit a site using DoubleClick advertising (including some Google AdSense advertisements). The cookie is used to serve your specific ads and your interests ("interest based targeting"). The ads served are to be targeted on the basis of your previous browsing history (For example, if you are viewing sites for visiting Las Vegas, you may also see Las Vegas hotel advertisements when viewing a non-related site, such as a hockey site). DART uses "non personally identifiable information", which does NOT track your personal information, such as your name, email address, physical address, telephone number, social security numbers, bank account numbers or credit card numbers. You have the option to opt-out of this ad serving on all sites, using this advertising by visiting http://www.doubleclick.com/privacy/dart_adserving.aspx 
		</p>
		<p>
		You can choose to disable or selectively turn off our cookies or third-party cookies in your browser settings, or by managing preferences in programs such as Norton Internet Security. However, it can affect your ability to interact with our site as well as other websites and it may include the inability to login to services or programs, such as logging into forums or accounts.
		</p>
		<p>
		Deleting cookies does not mean you are permanently opted out of any advertising program. Unless, you have settings that disallow cookies, the next time you visit a site running the advertisements, a new cookie will be added.</p>';
return $str;
}
function get_default_terms_content()
{
		$str='<p><strong>BEFORE USING THIS SITE, PLEASE GO THROUGH THE USE OF CAREFULLY TERMS AND CONDITIONS.</strong></p>

<p>Our visitors may use this site free. And, the users using this site agree to comply and bound by the below mentioned terms of use. If you do not agree to the given terms and conditions after reviewing it thoroughly, you are requested not to use the site: </p>

<p>
<ol>
<li>
<strong>Acceptance of Agreement:</strong> The terms and conditions featured in this Terms and Conditions of use Agreement (Agreement) related to our site (the site) are agreed by you. This Agreement represents the complete and only agreement between you and us, and supersedes all prior or contemporaneous agreements, representations, warranties and understandings related to the Site, free product samples, the content, or freebie offers or services provided by or listed on the Site, and the subject matter of this Agreement. We can amend the Agreement any time and at any frequency without informing or specific notice to you. The latest Agreement will be posted on the site that can be reviewed by you prior to using the site. This Agreement may be amended by us at any time and at any frequency without specific notice to you. The latest Agreement will be posted on the Site, and you should review this Agreement prior to using the Site.
</li>
<li>
<strong>Copyright.</strong> The organization, content, design, graphics, and other materials related to this Site are protected under applicable copyrights and other proprietary laws, including but not limited to intellectual property laws. Without our prior written permission, the copying, reproduction, use, modification or publication of full or part of any such matters or any part of the Site by you is strictly prohibited. 
</li>
<li>
<strong>Deleting and Modification.</strong> We reserve the right in our sole discretion, to edit or delete any documents, information or other content appearing on the Site, including this Agreement without any notice requirement or obligation to you.
</li>
<li>
<strong>Indentification.</strong> You agree to indemnify, defend and hold us, our officers, our share holders, our partners, attorneys and employees harmless from any and all liability, loss, damages, claim and expense, including reasonable attorney\'s fees, related to your violation of this Agreement or use of the Site.
</li>

</ol>
<ol>
<li>
<strong>Disclaimer.</strong> THE CONTENT, SERVICES, FREE PRODUCT SAMPLES AND FREEBIE OFFERS FROM OR LISTED THROUGH THE SITE ARE PROVIDED "AS-IS," "AS AVAILABLE," AND ALL WARRANTIES, EXPRESS OR IMPLIED, ARE DISCLAIMED, INCLUDING BUT NOT LIMITED TO THE DISCLAIMER OF ANY IMPLIED WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY, QUALITY AND FITNESS FOR A PARTICULAR PURPOSE, WITH RESPECT TO THIS SITE AND ANY WEBSITE WITH WHICH IT IS LINKED. THE INFORMATION AND SERVICES MAY CONTAIN BUGS, ERRORS, PROBLEMS OR OTHER LIMITATIONS. WE HAVE NO LIABILITY WHATSOEVER FOR YOUR USE OF ANY INFORMATION OR SERVICE. IN PARTICULAR, BUT NOT AS A LIMITATION, WE ARE NOT LIABLE FOR ANY INDIRECT, INCIDENTAL OR CONSEQUENTIAL DAMAGES (INCLUDING DAMAGES FOR LOSS OF BUSINESS, LOSS OF PROFITS, LOSS OF MONEY, LITIGATION, OR THE LIKE), WHETHER BASED ON BREACH OF CONTRACT, BREACH OF WARRANTY, NEGLIGENCE, PRODUCT LIABILITY OR OTHERWISE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE NEGATION OF DAMAGES SET FORTH ABOVE ARE FUNDAMENTAL ELEMENTS OF THE BASIS OF THE BARGAIN BETWEEN US AND YOU THE USER. THIS SITE AND THE INFORMATION WOULD NOT BE PROVIDED WITHOUT SUCH LIMITATIONS. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM US THROUGH THE SITE SHALL CREATE ANY WARRANTY, REPRESENTATION OR GUARANTEE NOT EXPRESSLY STATED IN THIS AGREEMENT. THE INFORMATION AND ALL OTHER MATERIALS ON THE SITE ARE PROVIDED FOR GENERAL INFORMATION PURPOSES ONLY AND DO NOT CONSTITUTE PROFESSIONAL ADVICE. IT IS YOUR RESPONSIBILITY TO EVALUATE THE ACCURACY AND COMPLETENESS OF ALL INFORMATION AVAILABLE ON THIS SITE OR ANY WEBSITE WITH WHICH IT IS LINKED.
</li>
<li>
<strong>Limits.</strong>  We disclaim all responsibility or liability for any damages caused by viruses contained within the electronic file containing the form or document.. We disclaim any form of the liability to you for any incidental, special or consequential damages of any kind that may result from use of or inability to use the site.
</li>
<li>
<strong>Third-Party Website.</strong> All rules, terms and conditions, other policies (including privacy policies) and operating procedures of third-party linked websites will apply to you while on such websites. For the content, accuracy or opinions expressed in such Websites, we are not responsible, and we have also not investigated, monitored or checked for accuracy or completeness of such websites. Any linked Website inclusion on our Site does not imply endorsement or approval of the linked Website by us. This Site and the third-party linked websites are independent entities and neither party has authority to make any representations or commitments on behalf of the other. You are acting at your own risk if you decide to leave our Site and access these third-party linked sites.
</li>
<li>
<strong>Third-Party Products and Services.</strong> Our site advertise third-party linked websites from which you may purchase or otherwise obtain certain freebie offerings, sample goods, or free trial services. It must be fully understood that we do not operate or control the free offerings, products, or services offered by third-party linked websites. The responsibility solely lies with the third-party linked websites for all aspects of order processing, billing fulfillment, and customer services. For any transactions entered into between you and third-party linked websites we are not a party to it. You agree that use of such third-party linked websites is at your sole risk and is without warranties of any kind by us, expressed, implied or otherwise. Under no circumstances are we liable for any damages arising from the transactions between you and third-party linked websites or for any information appearing on third-party linked websites or any other site linked to or from our site.
</li>
<li>
<strong>Submissions.</strong> All ideas, notes, suggestions, concepts and other information send by you to us (collectively, "Submissions") shall be deemed and shall remain our sole property and shall not be subject to any obligation of confidence on our part. Without limiting the foregoing, we shall be deemed to own all known and hereafter existing rights of every kind and nature regarding the Submissions and shall be entitled to unrestricted use of the Submissions for any purpose, without compensation to the provider of the Submissions.
</li>
<li>
<strong>General.</strong> You agree that all actions or proceedings arising directly or indirectly out of this agreement, or your use of the site or any sample products, freebie offers or services obtained by you through such use, shall be litigated in the circuit court of Los Angeles County, California or the United States District Court for the Central District of California. you are expressly submitting and consenting in advance to such jurisdiction in any action or proceeding in any of such courts, and are waiving any claim that Los Angeles, California or the central district of California is an inconvenient forum or an improper forum based on lack of venue. This site is controlled by Perfect Insight, Inc. in the State of California, USA. As such, the laws of California will govern the terms and conditions contained in this Agreement and elsewhere throughout the Site, without giving effect to any principles of conflicts of laws.
</li>
</ol>
</p>';
return $str;
}
function site_head_syon()
{
	?>
	<style type="text/css">
	/*
	Settings for Syon Policy
	*/
	#syon-privacy
	{
		font-family:Arial;
		font-size:12px;
	}
	</style>
	<?
}
add_action('wp_head', 'site_head_syon');


function syon_policy_func()
{
	return "<div id='syon-privacy'>".get_content1()."</div>";
}
function syon_terms_func()
{
	return "<div id='syon-privacy'>".get_syon_terms1()."</div>";
}
add_shortcode( 'syonpolicy', 'syon_policy_func' );

add_shortcode( 'syonterms', 'syon_terms_func' );
function feedback_form()
{
?>
  <div class="syon-wrap">
  <h1>Suggestion For Syon Privacy Policy</h1>
       <h4>Your Suggestions</h4>
         <p>    If you have any suggestions or questions regarding to this plugin please inform us by filling this form and we will update or get back to you as soon as possible.<br />
Thanks</p>
<table cellpadding="2" cellspacing="2" border="0" width="100%" class="syonTable">

        
        <tr>
        <td id="syonError">
        </td>
        </tr>
        <tr>
        <td id="syonSuccess">
        </td>
        </tr>
        <tr>
        	<td id="formtd">
            <form action="../wp-content/plugins/<?php echo get_policy_dir_name();?>/sendmail.php" method="post" target="savingframe" onsubmit="return validate_feedback()">
            <table cellpadding="2" cellspacing="2" width="100%">
            	<tr>
                	<td width="100"><label>Your Name</label></td>
                    <td width="200"><input type="text" name="uname" id="uname" class="mtext"  /></td> 
                    <td align="left">
                    <font class="mandatory">*</font>
                    </td>
                </tr>
                <tr>
                	<td width="100"><label>Your Email</label></td>
                    <td width="200"><input type="text" name="umail" id="umail" class="mtext"  value="<?php echo(get_option('admin_email')) ?>"/>
                    </td> 
                    <td align="left">
                    <font class="mandatory">*</font>
                    </td>
                </tr>
                <tr>
                	<td width="100" valign="top"><label>Message</label></td>
                    <td width="200"><textarea name="syonmessage" id="syonmessage" class="syonarea"></textarea>
                    </td> 
                    <td align="left" valign="top">
                    <font class="mandatory">*</font>
                    </td>
                </tr>
			<tr>
			<td>&nbsp;
				
			</td>
			<td align="right">
				<input type="submit" name="Submit" value="Send">&nbsp;
			</td>
				<td>
                </td>
		</tr>
            </table>
            </form>
            <iframe name="savingframe" id="savingframe" style="display:none;"></iframe>
            </td>
        </tr>
</table>
</div>
<?	
}
add_action("admin_head","policy_admin_head");
function policy_admin_head()
{
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
	?>
	<link rel="stylesheet" type="text/css" href="../wp-content/plugins/<?php echo get_policy_dir_name();?>/syonpolicy.css"/>
	<script type="text/javascript">
	function validate_feedback()
	{
		var umail=document.getElementById("umail").value;
		var uname=document.getElementById("uname").value;
		var syonmessage=document.getElementById("syonmessage").value;
		uname=uname.replace(/\s+/g,'');
		umail=umail.replace(/\s+/g,'');
		syonmessage=syonmessage.replace(/\s+/g,'');
		if(uname.length<=0)
		{
document.getElementById("syonError").innerHTML="<font color='red'><strong>Error, Fields marked with * are mandatory.</strong></font>";
			return false;
		}
		if(umail.length<=0)
		{
			document.getElementById("syonError").innerHTML="<font color='red'><strong>Error, Fields marked with * are mandatory.</strong></font>";
			return false;
		}
		if((umail.indexOf(".")<=0) || (umail.indexOf("@")<=0))
		{
	document.getElementById("syonError").innerHTML="<font color='red'><strong>Error, Invalid email.</strong></font>";
			return false;
		}
		if(syonmessage.length<=0)
		{
		
			document.getElementById("syonError").innerHTML="<font color='red'><strong>Error, Fields marked with * are mandatory.</strong></font>";
			return false;
		}
	}
	</script>
	<?
}
?>