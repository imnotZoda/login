<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container1 {
    position: fixed;
    top: 100px; /* Adjust as needed */
    right: 0; /* Align to the right side of the page */
    margin-right: 5%; /* Negative margin to shift it off-screen to the right */
    width: 500px;
    border-radius: 8px;
    padding: 40px;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1),
                0 5px 12px -2px rgba(0, 0, 0, 0.1),
                0 18px 36px -6px rgba(0, 0, 0, 0.1);
}

.container form {
    margin-top: 30px;
    width: 500px;
   
}

.container .title{
    font-size: 20px;
    font-family: Arial, Helvetica, sans-serif;
    margin-top: 300px;
    margin-left: 40px;
}

.container form input{
    display: none;

}

.container form .category{
    margin-top: 10px;
    padding-top: 20px;

    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 15px;
}

.category label{
    /* width: 100%; */
    /* height: 65px; */
    height: 145px;
    padding: 20px;
    box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2);
    display: flex;
    /* justify-content: space-between; */
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
}

/* Style for Checkout button */
.checkout-btn {
    background-color: #6064b6;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 20px;
    width: 100%;
}

.checkout-btn:hover {
    background-color: #434671;
}

/* label:nth-child(2), label:nth-child(3){
    margin: 15px 0;
} */


#visa:checked ~ .category .visaMethod,
#mastercard:checked ~ .category .mastercardMethod,
#paypal:checked ~ .category .paypalMethod,
#AMEX:checked ~ .category .amexMethod{
    box-shadow: 0px 0px 0px 1px #6064b6;
}


#visa:checked ~ .category .visaMethod .check,
#mastercard:checked ~ .category .mastercardMethod .check,
#paypal:checked ~ .category .paypalMethod .check,
#AMEX:checked ~ .category .amexMethod .check{
    display: block;
}


label .imgName{
    display: flex;
    /* justify-content: space-between;
     */
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    flex-direction: column;
    gap: 10px;
}

.imgName span{
    /* margin-left: 20px; */
    font-family: Arial, Helvetica, sans-serif;

    position: absolute;
    top: 72%;
    transform: translateY(-72%);
}

.imgName .imgContainer{
    width: 50px;
    display: flex;
    justify-content: center;
    align-items: center;

    position: absolute;
    top: 35%;
    transform: translateY(-35%);
}

img{
    width: 50px;
    height: auto;
}

.visa img{
    width: 80px;
    /* margin-left: 5px; */
}

.mastercard img{
    width: 65px;
}

.paypal img{
    width: 80px;
}

.AMEX img{
    width: 50px;
}

.check{
    display: none;
    position: absolute;
    top: -4px;
    right: -4px;
}

.check i{
    font-size: 18px;
}












input[type="radio"] {
            display: none;
        }

.orderposition{
    margin-top: 80px;
    left: 10%;
    position: absolute;
    width: 55%;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1),
                0 5px 12px -2px rgba(0, 0, 0, 0.1),
                0 18px 36px -6px rgba(0, 0, 0, 0.1);
                border-radius: 30px;
                padding-bottom: 200px;
}

.card {
    margin: 40px 0px;
    padding: 40px 50px;
    border-radius: 20px;
    border: none;
    box-shadow: 1px 5px 10px 1px rgba(0,0,0,0.2);
    margin-left: 300px;
    left: -390px;
    margin-top: 500px;
}

input, textarea {
    background-color: #F3E5F5;
    padding: 8px 15px 8px 15px;
    width: 100%;
    border-radius: 5px !important;
    box-sizing: border-box;
    border: 1px solid #F3E5F5;
    font-size: 15px !important;
    color: #000 !important;
    font-weight: 300;
}

input:focus, textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #9FA8DA;
    outline-width: 0;
    font-weight: 400;
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0;
}


.gray {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    filter: grayscale(100%);
    color: #E0E0E0;
}

.gray .pay {
    box-shadow: none;
}

#tax {
    border-top: 1px lightgray solid;
    margin-top: 10px;
    padding-top: 10px;
}

.btn-blue {
    border: none;
    border-radius: 10px;
    background-color: #673AB7;
    color: #fff;
    padding: 8px 15px;
    margin: 20px 0px;
    cursor: pointer;
}

.btn-blue:hover {
    background-color: #311B92;
    color: #fff;
}

#checkout {
    float: left;
}

#check-amt {
    float: right;
}

@media screen and (max-width: 768px) {
    .book, .book-img {
        width: 100px;
        height: 150px;
    }

    .card {
        padding-left: 15px;
        padding-right: 15px;
    }

    .mob-text {
        font-size: 13px;
    }

    .pad-left { 
        padding-left: 20px;
    }
}

#totals{
    margin-left: 100px;
}

</style>
