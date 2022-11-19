@extends('layouts.home')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
  
        <h3 class="my-4 display-5 fw-bold">Welcome {{$user->name}}</h3>

    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
<div class="col-md-12">
  <ul class="nav nav-tabs" id="mytab" role="tablist">
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="tab" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</button>
</li>
<li class="nav-item" role="presentation">
    <button class="nav-link" id="v-pills-orders-tab" data-bs-toggle="tab" data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false">Orders</button>
</li>
<li class="nav-item" role="presentation">
    <button class="nav-link" id="v-pills-wishlist-tab" data-bs-toggle="tab" data-bs-target="#v-pills-wishlist" type="button" role="tab" aria-controls="v-pills-wishlist" aria-selected="false">Wishlist</button>
</li>
<li class="nav-item" role="presentation">
    <button class="nav-link" id="v-pills-message-tab" data-bs-toggle="tab" data-bs-target="#v-pills-message" type="button" role="tab" aria-controls="v-pills-message" aria-selected="false">Notifications</button>
</li>

<li class="nav-item" role="presentation">
    <button class="nav-link" id="v-pills-contact-tab" data-bs-toggle="tab" data-bs-target="#v-pills-contact" type="button" role="tab" aria-controls="v-pills-contact" aria-selected="false">Contact & Support</button>
</li>

  </ul>

             @if(session()->has('message'))
             <div class="alert alert-success">
               {{ session()->get('message') }}
             </div>
             @endif

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
       
           <div class="card row">
            <div class="card-header">
                <h5 class="card-title">Profile</h5>
                
             @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            </div>
            <div class="card-body">
               <form class="form" role="form" method="post" action="{{url('update-profile')}}">
                @csrf
                <input type="hidden" name="id" value="{{isset($userid) ? $userid : '' ;}}">
                <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Name</label>
                      <input type="name" name="name" class="form-control" value="{{$user->name}}" id="uname" placeholder="name" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Email address</label>
                      <input type="email" name="email" readonly class="form-control" id="uemail" value="{{$user->email}}" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Phone</label>
                      <input type="tel" class="form-control" name="phone" value="{{$user->phone}}" id="uphone" placeholder="phone" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Current Password</label>
                       <input type="password" name="cpwd" class="form-control" value="" id="cupassword" placeholder=" current passsword">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">New Password</label>
                       <input type="password"  name="npwd" class="form-control" value="" id="nupassword" placeholder=" new passsword" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update profile</button><a href="{{url('password/reset')}}" role='button' class="btn btn-warning">Forgot Password</a>
               </form>
            </div>
        </div>

              
    </div>
    <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
         <div class="card row">
            <div class="card-header">
                <h5 class="card-title">Orders</h5>
            </div>
            <div class="card-body">
                @if(count($orders))
                <table class="table  table-hover table-sm" id="ordertable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order Id</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Transaction Id</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        @if($order)
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>
                                @if($order->items)
                                 @foreach($order->items as $item)
                                    <span class="badge">{{$item->product ? $item->product->title:''}}</span>
                                 @endforeach

                                @endif


                            </td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->transaction_id}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td><a href="" data-id="{{$order->id}}" data-user_id="{{$order->user_id}}">View</a> | <a href="" data-id="{{$order->id}}" data-user_id="{{$order->user_id}}">Cancel</a></td>

                        </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab">
        <div class="card row">
            <div class="card-header">
                <h5 class="card-title">Wishlist</h5>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="v-pills-message" role="tabpanel" aria-labelledby="v-pills-message-tab">
        <div class="card row">
            <div class="card-header">
                <h5 class="card-title">Messages</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">List group item heading</h5>
                      <small>3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small>And some small print.</small>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">List group item heading</h5>
                      <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">List group item heading</h5>
                      <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                  </a>
                </div>
            </div>
        </div>
    </div>

     <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
         <div class="card row">
            <div class="card-header">
                <h5 class="card-title">Support</h5>
            </div>
            <div class="card-body">
               
               <div class="container py-4">

  <!-- Bootstrap 5 starter form -->

  <h5>Write us</h5>
  <form id="contactForm" action="{{url('support-from')}}" method="post" >
  @csrf
                <input type="hidden" name="id" value="{{$userid}}">
    <!-- Name input -->
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="{{$user->name}}" />
    </div>

    <!-- Email address input -->
    <div class="mb-3">
      <label class="form-label" for="emailAddress">Email Address</label>
      <input class="form-control" name="email" id="emailAddress" type="email" value="{{$user->email}}"  placeholder="Email Address" />
    </div>
    <div class="mb-3">
      <label class="form-label" for="emailAddress">Subject</label>
      <input class="form-control" name="subject" id="emailAddress" type="text" placeholder="Subject" />
    </div>

    <!-- Message input -->
    <div class="mb-3">
      <label class="form-label" for="message">Message</label>
      <textarea class="form-control" id="message" name="message" type="text" placeholder="Message" style="height: 10rem;"></textarea>
    </div>

    <!-- Form submit button -->
    <div class="d-grid">
      <button class="btn btn-primary btn-lg" type="submit">Submit</button>
    </div>

  </form>

</div>
            </div>
        </div>
     </div>
    
  </div>
  
  </div>
</div>
</div>
</section>
</div>
</main>

@endsection
