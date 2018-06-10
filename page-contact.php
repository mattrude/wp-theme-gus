<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>
	<div id=main role=main>
		<div id=post class=content itemscope itemtype="http://schema.org/Article">



<!-- The Contact section -->
<div class="container offsetanchor" id="contact">
  <div class="row">
    <hr />
    <h1 class="page-header text-center" style="border-bottom: 0px;margin:40px 0 30px;">Contact</h1>
    <div class="col-md-5">
    <h3>Contact Information</h3>
    <p>This site is maintained by Matt Rude (<a href="https://keyserver.mattrude.com/d/0xc4909ee495b0761f">0xc4909ee495b0761f</a>). If you would like to report any problems or bugs, please send a email or XMPP messsage to the email address listed in one of my public keys.</p>
    <p>If you are thankful for this service, please consider donating some funds to the cause. My bitcoin address is <code class="highlighter-rouge">1211xFABAc7W4QELfaGFvEqzUhVF2zbm33</code>.</p>
    <p>You may also see my profile on <a href="https://keybase.io/mattrude">keybase.io/mattrude</a>.</p>
    <ul id="contact-list" class="list-inline">
      <li><b><a href="mailto:matt@mattrude.com" title="Email Address"><i class="fa fa-envelope "></i></a></b></li>
      <li><b><a href="https://www.twitter.com/mdrude" title="Twitter Profile Page"><i class="fa fa-twitter-square"></i></a></b></li>
      <li><b><a href="https://www.facebook.com/mattrude" title="Facebook Profile Page"><i class="fa fa-facebook-official"></i></a></b></li>
      <li><b><a href="https://www.instagram.com//mattdrude" title="Instagram Profile Page"><i class="fa fa-instagram"></i></a></b></li>
      <li><b><a href="https://github.com/mattrude" title="Github Profile Page"><i class="fa fa-github"></i></a></b></li>
      <li><b><a href="xmpp:matt@mattrude.com" title="XMPP/Jabber ID"><i class="fa fa-commenting"></i></a></b></li>
      <li><b><a href="https://mattrude.com" title="Website"><i class="fa fa-link"></i></a></b></li>
      <li><b><a href="https://keyserver.mattrude.com/search/vindex/hash/fingerprint/0xc4909ee495b0761f" title="PGP Public Key"><i class="fa fa-key"></i></a></b></li>
    </ul>
</div>

<div class="col-md-7">
    <h3 id="my-public-pgp-key-information">My Public PGP Key Information</h3>
    <p><strong>My Default RSA Key:</strong></p>
    <div class="highlighter-rouge"><pre class="highlight"><code>uid = Matt Rude
pub = rsa2048/95B0761F 2015-03-02
sub = rsa2048/BC158061 2015-03-02
fingerprint = 71FD 20E3 2815 8C32 2133  FBBE C490 9EE4 95B0 761F</code></pre></div>
    <p><strong>My Elliptic Curve Cryptography (ECC) Key:</strong></p>
    <div class="highlighter-rouge"><pre class="highlight"><code>uid = Matt Rude
pub = nistp256/03305F35 2015-02-15
fingerprint = 77F1 D65B 5FF0 54DC 9286  6078 0314 CD85 0330 5F35</code></pre></div>
    <p>Or, you may validate my keys using one of my <a href="https://keyserver.mattrude.com/guides/dns-dane-cert-records/">DANE</a> or <a href="https://keyserver.mattrude.com/guides/public-key-association/">PKA</a> DNS records.</p></div>
</div>

<h3 id="signed-contact-information">Signed Contact Information</h3>

<p>A signed copy of this information may be found <a href="https://keyserver.mattrude.com/contact.txt">here</a>, or using my <a href="https://keyserver.mattrude.com/d/0x0314CD8503305F35">ECC key</a>, may be found <a href="https://keyserver.mattrude.com/contact-ecc.txt">here</a>. You may validate these files by running the below commands:</p>

<div class="highlighter-rouge"><pre class="highlight"><code style="overflow:auto;word-wrap:normal;white-space:pre;">curl -s https://keyserver.mattrude.com/contact.txt |gpg --keyserver-options auto-key-retrieve --auto-key-locate pka --verify
curl -s https://keyserver.mattrude.com/contact-ecc.txt |gpg --keyserver-options auto-key-retrieve --auto-key-locate pka --verify
</code></pre>
</div>

  </div>
</div>





		</div>
	</div>
<?php get_footer(); ?>
