<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

* {
    padding: 0%;
    margin: 0;
    font-family: 'Montserrat', sans-serif;
}

.container {
    height: 100vh;
    width: 100%;
    background: linear-gradient(to right, #f9b2d2 70%,  #f9b1d370 30%);
    position: relative;
    overflow: hidden;
}
.wave {
    position: absolute;
    top: -30%;
    right: 5%;
   

}

.wave img{
    position: absolute;
    top: 0;
    right: 30%;
    height: 1200px;
    fill: red;

}
nav {
    width: 90%;
    margin: auto;
    padding-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
nav ul {
    display: flex;
    list-style-type: none;  
}
nav ul li{
    margin:0 5px;
}
nav ul a{
    text-decoration: none;
    padding: 0.3rem 1.3rem;
    font-size: 17px;
    font-weight: bold;
    color: #494234;
    position: relative;
    z-index: 1;
}
nav ul a::after{
    content: "";
    width: 0%;
    height: 100%;
    position: absolute;
    top:0;
    left:0px;
    border-radius: 20px;
    background-color:  #F5F5F5;
    z-index: -1;
    transition: 0.5s;
}
nav ul a:hover:after{
    width: 100%;
}
.main-content {
    width: 60%;
    padding-top: 230px;
    margin-left: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-around;
}
.image-pista ,.main-text{
    flex-basis: 50%;
}
.image-pista img{
    width: 100%;
}
.main-content h1 {
    font-size: 60px;
    letter-spacing: 1px;
    color: #494234;
}
.main-content p{
    margin-top: 10px;
    font-size: 15px;
    letter-spacing: 1px;
}
.main-content button{
    margin-top: 2.5rem;
    outline: none;
    border: none;
    font-size: 18px;
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    border-radius: 0 50% 50% 0;
    background-color: #494234;
    color: white;
    cursor: pointer;
}
.swiper{
    width: 20rem;
}
.swiper-slide{
    display: flex;
    align-items: center;
    justify-content: center;
}
.right{
    position: absolute;
    right: 8%;
    bottom: 35%;
 
}
.box{
    display: flex;
    align-items: center;
}
.right .box .image img{
    width: 70%;
}
.image{
    margin-top: 2rem;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    box-shadow: -5px 5px 17px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
}
.image:hover{
    background-color: #F5F5F5;
}
.box .inner-box{
    margin: 1.5rem 0 0 1rem;
}
.box .inner-box p{
    font-size: 14px;
    font-weight: 500;
}
.social-links{
    position: absolute;
    right: 5%;
    bottom: 5%;
}
.social-links::before{
    content: "";
    width: 80%;
    height: 3px;
    position: absolute;
    top:42%;
    left: -150px;
    background-color: #494234;
}
.social-links i{
    margin-left: 10px;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color:  #f9b2d2;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
}
.social-links i:hover{
    transform: translateY(-5px);
}

.logo {

    background-size: contain;
    background-repeat: no-repeat;
    width: 500px;
    height: 500px;
    position: absolute;
    top: -120px; /* Adjust the top position as needed */
    right: 50px; /* Adjust the left position as needed */
    z-index: 999; /* Ensure the logo appears above other elements */
}

</style>