<?php ?>
<footer class="mm-container">
    <ul class="footer-icons">
        <li><i class="fa-brands fa-facebook fa-xl"></i></li>
        <li><i class="fa-solid fa-envelope fa-xl"></i></li>
        <li><i class="fa-solid fa-headphones fa-xl"></i></li>
    </ul>
    <ul class="footer-list">
        <li>Policy</li>
        <li>Terms and Service</li>
        <li>About us</li>
    </ul>
    <p>&#169 2022 The Music Manager</p>
</footer>
<style>
   .footer-icons {
       display: flex;
       gap: 20px;
       align-items: center;
       justify-content: center;
       list-style: none;
   }

   .footer-icons i {
       color: var(--white);
       transition: all 0.3s;
       cursor: pointer;
   }

   .footer-icons i:hover {
       color: var(--purple);
   }

   footer {
       padding: 100px;
   }

   .footer-list {
       color: var(--white);
       display: flex;
       list-style: none;
       align-items: center;
       justify-content: center;
       gap: 16px;
       font-size: 16px;
       font-weight: 400;
       margin-top: 12px;
   }

   footer p {
       display: flex;
       align-items: center;
       justify-content: center;
       color: var(--white);
       font-size: 12px;
       font-weight: 400;
       margin-top: 8px;
   }
</style>
</body>
</html>


