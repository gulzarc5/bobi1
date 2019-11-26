		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
		<style>
			.disable_input{
				background: #d6cfcf none repeat scroll 0 0 !important;
				color: black !important;
    			font-weight: bold !important;
			}
		</style>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">Terms & Condition, Return policy, Disclamer</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title-5 mb-30" style="text-align: center;">
							<h2>Terms & Condition, Return policy, Disclamer</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area user-detail mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="checkbox-form mb-25">
							<div class="row">
								{{-- Section --}}
								<h5>Terms and Conditions</h5>
								<p>These Terms of Service (the "Terms of Service" or "TOS") act as a binding contract between edujiyaan.com and you, the user and shall thus apply to and govern your use, and any use by another person, of your User Account, as well as your use of this Site and the Services. Your use of the Site and/or any Service signifies your agreement to be bound by these Terms of Service and the edujiyaan.com Privacy Policy.</p>	
								{{-- Section --}}
								<h5>User Account, Password, and Security</h5>
								<p>You will receive a password and account designation upon completing the Website's registration process. You are responsible for maintaining the confidentiality of the password and account, and are fully responsible for all activities that occur under your password or account. You agree to (a) immediately notify edujiyaan.com of any unauthorized use of your password or account or any other breach of security, and (b) ensure that you exit from your account at the end of each session. Edujiyaan.com cannot and will not be liable for any loss or damage arising from your failure to comply with this.</p>	
								{{-- Section --}}
								<h5>License to use the site</h5>
								<p>Edujiyaan.com grants you a non-exclusive, non-transferable, limited right and license to access, use and privately display the Site and the Site Content as described herein for your personal use only, by way of one (1) computer connected to the Site over the Internet, provided that you comply fully with these TOS. You may "cache" pages of the Site for the sole purpose of increasing the speed and efficiency at which you access the Site. Any other copy or use of a portion of the Site is not authorized, and will be a violation of these TOS and will constitute a violation of copyright and other such rights which Edujiyaan.com may have in and with respect to this Site and the Contents on this Site. You shall not interfere, or attempt to interfere, with the operation of the Site in any way through any means or device, including, but not limited to, spamming, hacking, uploading computer viruses, or any other means expressly prohibited by any provision of these TOS or by law.</p>	
								{{-- Section --}}
								<h5>Privacy Policy</h5>
								<p>The User hereby consents, expresses and agrees that he has read and fully understands the Privacy Policy of Edujiyaan.com the Website. The user further consents that the terms and contents of such Privacy Policy are acceptable to him</p>	
								{{-- Section --}}
								<h5>Links To Third Party Sites</h5>
								<p>The Website may contain links to other websites ("Linked Sites").The Linked Sites are not under the control of edujiyaan.com and edujiyaan.com is not responsible for the contents of any Linked Site, including without limitation any link contained in a Linked Site, or any changes or updates to a Linked Site. The users are requested to verify the accuracy of all information on their own before undertaking any reliance on such information. The sole motive behind the site is to provide platforms, anyone can buy and sell from this site. Edujiyaan.com is not liable if any person upload any contents from any other site.</p>
								{{-- Section --}}
								<h5>Termination</h5>
								<p>These terms and conditions are applicable to you upon your accessing the Site and/or completing the registration or shopping process. These TOS, or any of them, may be modified or terminated by edujiyaan.com without notice at any time for any reason. Edujiyaan.com may suspend or terminate your use of the Website or any Service if it believes, in its sole and absolute discretion that you have breached any of the Terms.</p>
								{{-- Section --}}
								<h5>Pricing</h5>
								<p>Prices for products are described on our Website. All prices are in Indian rupees. Prices, products and Services may change at Edujiyaan.com’s discretion.</p>
								{{-- Section --}}
								<h5>Governing Law</h5>
								<p>These terms shall be governed by and constructed in accordance with the laws of India without reference to conflict of laws principles and disputes arising in relation hereto shall be subject to the exclusive jurisdiction of the courts at Assam.</p>
								{{-- Section --}}
								<h5>Disclaimer of warranty; limitation of liability</h5>
								<p>While Edujiyaan.com uses reasonable efforts to include accurate and up to date information in the Site, Edujiyaan.com makes no warranties or representations as to its accuracy. By accessing this site, you agree that the use of this site is at your sole risk. This site is provided on an "as is" and "as available" basis without warranties of any kind, either express or implied, including (but not limited to) warranties of merchantability or fitness for a particular purpose.
								This disclaimer and limitation of liability applies to any damages or injury caused by any failure of performance, error, omission, interruption, deletion, defect, delay in operation or transmission, computer virus, communication line failure, theft, destruction or unauthorized access to, alteration of, or use of record, whether for breach of contract, tortious behavior, negligence, or under any other cause of action. By accessing this site, you agree that in no event shall Edujiyaan.com be liable for any damages (including without limitation) direct, indirect, incidental, special, consequential, or punitive damages arising out of the use of, or inability to use, this site. You specifically acknowledge and agree that Edujiyaan.com is not liable for the defamatory, offensive, or illegal conduct of its visitors or customers, and the liability and risk of injury for the foregoing rests entirely with the visitor or customer.</p>
								{{-- Section --}}
								<h5>Changes to site and/or terms of service</h5>
								<p>Edujiyaan.com reserves the right, at its sole discretion, to change, modify, add or remove any portion of the Site, the Site Content, the TOS, and/or the Privacy Policy, in whole or in part, at any time. Changes to the TOS and Privacy Policy will be effective when posted. You agree to review the TOS and Privacy Policy periodically to become aware of any changes. Your use of the Site after any changes to the TOS and/or Privacy Policy are posted will be considered acceptance of those changes and will constitute your agreement to be bound thereby.</p>
								{{-- Section --}}
								<h5>Eligibility</h5>
								<p>The Edujiyaan.com Platform is not available to persons under the age of majority in their jurisdiction or to any users previously suspended or removed from the Edujiyaan.com Platform by Edujiyaan.com. If You are using or opening an account on the Edujiyaan.com Platform on behalf of a company, entity, or organization (collectively “Subscribing Organization”), then You represent and warrant that You are an authorized representative of that Subscribing Organization with the authority to bind such organization to these Terms; and agree to be bound by these Terms on behalf of such Subscribing Organization. BY USING THE EDUJIYAAN.COM PLATFORM, YOU REPRESENT THAT You meet the eligibility requirements in this Section. In any case, You affirm that You are at least 13 years old, as the Edujiyaan.com Platform is not intended for children under 13.</p>	
								{{-- Section --}}
								<h5>Paid Access</h5>
								<p>Edujiyaan.com offers several ways for You to purchase access to select content via the Edujiyaan.com Platform: You can pay for a membership (“Membership”) for access to certain content, or pay a one-time fee for access to a certain piece of content (“Direct Purchase”).</p>
								<ol>
									<li>
										<strong>Edujiyaan.com</strong> provides You with access to eBooks, audio books and documents from participating publishers and Users (“Edujiyaan.com Commercial Content”) in one of two ways – either by Direct Purchase or by Membership.
										<ol type="A"><br>
											<li>
												<strong>Memberships -</strong> In the case of Membership, Edujiyaan.com, and the participating publishers or Users, grant You a limited, nonexclusive, nontransferable, revocable and personal license to access and use all Edujiyaan.com Commercial Content available under Your Membership for Your personal reference and informational purposes.
											</li>
											<br>
											<li>
												<strong>Direct Purchases -</strong> In the case of Direct Purchases, Edujiyaan.com, and the participating publisher or User, grant You a limited, nonexclusive, nontransferable, revocable and personal license to access and use a digital copy of the selected Edujiyaan.com Commercial Content for Your personal reference and informational purposes.  Additional terms and conditions (i.e., additional usage limitations) may apply to Your access to Edujiyaan.com Commercial Content in which case those terms will be communicated to you in connection with your access to such content. For example, the rights granted to You do not include the right to download a copy of the selected Edujiyaan.com Commercial Content unless the such terms are provided with the Edujiyaan.com Commercial Content you have selected for Direct Purchase.
											</li><br>
										</ol>
									</li>
									<li>
										<strong>Restrictions :</strong>  Regardless of which access option You have selected (Direct Purchase or Membership) Your access to and use of the Edujiyaan.com Commercial Content is subject to the following restrictions:	
										<ol type="A"><br>
											<li>Edujiyaan.com Commercial Content is provided for Your personal non-commercial use only.</li>

											<li>No commercial or promotional use rights are granted in any Edujiyaan.com Commercial Content.</li>

											<li>You may not sell, distribute, or display any Edujiyaan.com Commercial Content other than for personal use.</li>

											<li>You may not share, lend, or rent copies of Edujiyaan.com Commercial Content.</li>

											<li>You may not disable or circumvent Digital Rights Management (DRM) supplied with Edujiyaan.com Commercial
												content.</li>

											<li>You may not exceed usage limitations set by content providers (participating publisher or User).</li>

											<li>You may not make copies of all or any portion of any Edujiyaan.com Commercial Content.</li>

											<li>You are prohibited from making any public display or public performance of Edujiyaan.com Commercial Content, or sharing accounts that allow access to Edujiyaan.com Commercial Content.</li>

											<li>The ability to print/copy/paste and/or download may be restricted by the participating publisher or User who submitted the Edujiyaan.com Commercial Content.</li>
										</ol>
									</li>
								</ol>
								<p>In addition to the foregoing, if You have obtained access to Edujiyaan.com Commercial Content by purchasing a Membership, except for any limited time promotions, Your access to the Membership is conditioned upon timely payment and maintenance of Your Membership account; and You will not have access to Edujiyaan.com Commercial Content if Your Membership is cancelled, allowed to lapse, or terminated for non-payment.</p>

								<p>Your subscription entitles you to access an unlimited number of books and audio books in the Edujiyaan.com library during the subscription period. For a small percentage of Edujiyaan.com users who consume an unusual volume of materials, not every book or audio book in the library will be immediately available. Edujiyaan.com reserves and shall have the right in its sole discretion to add, modify, withdraw or delay at any time any particular Edujiyaan.com Commercial Content from access by you for any reason including, without limitation, based on the costs generated to Edujiyaan.com by such content or the nature of your use of the Edujiyaan.com.com website. Edujiyaan.com makes no guarantee as to the availability of specific titles or the timing of their availability.</p>
								{{-- Section --}}
								<h5>Payments and Billing</h5>
								<ol>						
									<li>For Direct Purchases and Memberships, the current fee amounts and any materially different terms from those described to you in this Agreement will be disclosed to you at sign-up or in other communications made available to you. When You purchase a Membership or a Direct Purchase (such purchase, a “Transaction”), we may ask You to supply additional information relevant to Your Transaction, including, without limitation, Your credit card number, the expiration date of Your credit card and Your billing address (such information, “Payment Information”). You represent and warrant that You have the legal right to use all payment method(s) represented by any such Payment Information. When You initiate a Transaction, You authorize us to provide Your Payment Information to third parties so we can complete Your Transaction and to charge Your payment method for the type of Transaction You have selected; You may need to provide additional information to verify Your identity before completing Your Transaction (such information is included within the definition of Payment Information).</li>
									<br>
									<li>If You elect to purchase an annual or monthly Membership, You will be charged the annual or monthly Membership fee (“Membership Fee”) at the beginning of the paying portion of Your Membership and each year or month thereafter, respectively, at the then-current rate. If You elect to purchase an annual Membership, we will automatically charge You on the anniversary of the commencement of the paying portion of Your Membership using the Payment Information You have provided. If You elect to purchase a monthly Membership, we will automatically charge You each month, on the calendar day corresponding to the commencement of the paying portion of Your Membership, using the Payment Information You have provided. In the event Your Membership began on a day not contained in a given month, we may charge Your payment method on a day in the applicable month or such other day as we deem appropriate. For example, if You started Your Membership on January 31st, Your next payment date is likely to be February 28th, and Your payment method would be billed on that date.</li> 
									<br>
									<li>By entering into the Agreement and electing to purchase an annual or monthly Membership, You acknowledge that Your Membership has recurring payment features and You accept responsibility for all recurring payment obligations prior to cancellation of Your Membership by You or Edujiyaan.com.  We may also periodically authorize Your payment method in anticipation of applicable fees or related charges. Your Membership continues until cancelled by You or we terminate Your access to or use of the Edujiyaan.com Platform or the Membership in accordance with this Agreement (and the Terms of Use which forms part of this Agreement).</li>
									<br>
									<li>Edujiyaan.com may offer a free trial Membership (“Free Trial”) for a specified period of time (“Free Trial Term”). If we offer You a Free Trial, the specific terms of Your Free Trial will be provided at signup and/or in the promotional materials describing the Free Trial. Free Trials may not be combined with any other offer. If you cancel your Free Trial before the expiration of the Free Trial Term, you may be eligible to use any unused portion of such Free Trial Term the next time you sign up for a Edujiyaan.com Membership, provided that Edujiyaan.com continues to offer the Free Trial that you were previously offered. Except as may otherwise be provided in the specific terms for the Free Trial offer, Free Trials are only available to users who have not previously completed a Free Trial  for a Membership to the Edujiyaan.com Platform. Unless You cancel Your Membership prior to the end of Your Free Trial, we (or our third party payment processor) will begin charging Your payment method on a recurring basis for the Membership Fee (plus any applicable taxes and other charges) until You cancel Your Membership. Instructions for cancelling Your Membership are stated below under the Section titled “Cancellation and Termination”. You will not receive a notice from us that Your Free Trial has ended or that the paid portion of Your Membership has begun. We reserve the right to modify or terminate Free Trials at any time, without notice and in our sole discretion.</li>
								</ol>	
								{{-- Section --}}
								<h5>Refunds and Replacements.</h5>
								<p>All fees and charges are nonrefundable and there are no refunds or credits.</p>	
								{{-- Section --}}
								<h5>Cancellation of Memberships.</h5>
								<p>You may cancel Your Membership at any time. THERE ARE NO REFUNDS OF ANY FEES OR CHARGES FOR MEMBERSHIPS. IF YOU CANCEL YOUR MEMBERSHIP, YOU WON’T RECEIVE A REFUND OF ANY PORTION OF THE MEMBERSHIP FEE PAID FOR THE THEN CURRENT MEMBERSHIP PERIOD AT THE TIME OF CANCELLATION. To cancel a Membership, you can do so through the Edujiyaan.com Platform by logging into the Site or the App and going to Your account settings. You may also email support@edujiyaan.com to initiate cancellation of a Membership. You will be responsible for all Membership Fees (plus any applicable taxes and other charges) incurred before the effective date of your cancellation. If you cancel, your cancellation will be effective immediately, but Edujiyaan.com will allow You to access the Edujiyaan.com Commercial Content until the most recently paid-up Membership period ends, and then will terminate Your access to Edujiyaan.com Commercial Content, including any Edujiyaan.com Commercial Content that You accessed using Your Edujiyaan.com Credits. Cancelling Your Membership won’t cancel Your Account. For example, if You made a Direct Purchase of certain Edujiyaan.com Commercial Content, You will continue to be able to access such Edujiyaan.com Commercial Content after cancelling Your Membership, unless Your account is terminated. See Section 9 below titled “Term and Termination,” for information on terminating Your account. You agree that Edujiyaan.com may terminate Your Membership and/or account for non-payment of Membership Fees. In the event of any cancellation or termination of your Membership or account, we may remove and discard all or any part of Your account, User profile, and any content related to Your account, at any time.</p>	
								{{-- Section --}}
								<h5>Digital Millennium Copyright Act.</h5>
								<p>Please note that since we respect authors’ and content holders’ rights, it is Edujiyaan.com’s policy to respond to notices of alleged infringement that comply with the Indian Copyright Act. Please note that Edujiyaan.com will promptly terminate without notice any User’s access to the Edujiyaan.com Platform if that User is determined by Edujiyaan.com to be a “repeat infringer”. A repeat infringer is a User who has been notified by Edujiyaan.com of infringing activity violations more than twice as a result of DMCA takedown notices or other similar copyright notices.</p>	
								{{-- Section --}}
								<h5>Claims</h5>
								<p>
									<strong>YOU AND EDUJIYAAN.COM AGREE THAT ANY CAUSE OF ACTION ARISING OUT OF OR RELATED TO THE EDUJIYAAN.COM PLATFORM MUST COMMENCE WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES.  OTHERWISE, SUCH CAUSE OF ACTION IS PERMANENTLY BARRED.</strong>
								</p>	
								{{-- Section --}}															
							</div>												
						</div>						
					</div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection