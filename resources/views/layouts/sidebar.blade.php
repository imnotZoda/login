@extends('layouts.css.sidecss')


<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v6.5.1/css/all.css" rel="stylesheet">
  </head>
  <body>
   
    <div class="sidebar">
      <header>Admin</header>
      <a href="/admin/home" class="active">
        <i class="fas fa-qrcode"></i>
        <span>Dashboard</span>
      </a>
      <a href="/suppliers">
        <i class="fas fa-user"></i>
        <span>Suppliers</span>
      </a>
      <a href="{{ route('product.index') }}">
        <i class="fas fa-stream"></i>
        <span>Products</span>
        </a>
     
      <a href="#">
        <i class="far fa-window-maximize"></i>
        <span>Order</span>
      </a>


      <a class="dropdown-item" href="{{ route('logout') }}"
      
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                  
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
                                        @csrf   
                                    </form>
   
      
    </div>
</body>
    

