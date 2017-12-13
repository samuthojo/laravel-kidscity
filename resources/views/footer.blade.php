<footer>
    <div class="footer-wrapper layout vertical">
        <div class="layout">
            <div id="subscribe" class="layout vertical end-justifie" style="display: none;">
                <p>
                    Get weekly updates
                </p>

                <div class="layout">
                    <input type="text" placeholder="Your email">
                    <button>
                        <i class="fa fa-send-o"></i>
                    </button>
                </div>
            </div>
            <div id="subscribe">
                <h3>
                    About Us
                </h3>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia perferendis, nihil veritatis rerum repellendus iure iste non impedit quasi atque incidunt.
                </p>
            </div>
            <div class="flex layout vertical">
                <div id="footerNav" class="layout justified">
                    <div>
                        <h5>Important Links</h5>
                        <ul>
                            <li>
                                <a href="login.php">Join Kid City</a>
                            </li>
                            <li><a href="#">Become a partner</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5>Contact Us</h5>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-phone"></i>&nbsp;&nbsp;
                                    +255 718 728 778
                                </a>
                            </li>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;
                                    info@kidcity.com
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="socialMediaLinks">
                        <h5>Social Media</h5>
                        <a href="#">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-twitter-square"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="copyright" class="layout center-center">
        <span>
            Copyright &copy;<span class="highlight">Kid City </span> 2017 &nbsp; | &nbsp;&nbsp;
        </span>
        <span>
            Web Strategies by
            <a href="http://ipfsoftwares.com" target="_blank" class="highlight">iPF Softwares</a>
        </span>
    </div>
</footer>

<script>
    var alertMessage = document.getElementById("alertMessage");
    var alertMessageText = document.getElementById("alertMessageText");
    function showMessage(message){
        alertMessageText.innerText = message;
        alertMessage.classList.add("slideInDown");
        setTimeout(function () {
            alertMessage.classList.add("slideOutUp");

            setTimeout(function (){
                alertMessage.classList.remove("slideInDown");
                alertMessage.classList.remove("slideOutUp");
            }, 300);
        }, 3200);
    }
</script>
</body>
</html>