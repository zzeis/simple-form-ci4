<style>
 footer{
        background-color: #ecfeeb;
        border: none;
        display: flex; 
        flex-direction: row;
        justify-content: space-evenly;
        color: #008080;
    }
    footer .social{
        display: flex;
        gap: 10px; 
        align-items: center;
       
    }
   .social i{
    font-size: 2rem;
   }
   .social img{
    width: 40px;
    height: 40px;
   }
</style>

<footer class="footer-social d-print-none text-center">
    <p class="sati d-print-none text-center ">&copy; <?= date('Y'); ?> - SATI</p>
</footer>



</body>

</html>