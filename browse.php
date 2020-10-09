<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> IAT352 PHP Project </title>

  <meta name="viewport" content="width=device-width, initial=scale=1.0"> <!-- -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.php">
  <link rel="stylesheet" href="css/fonts.css">


</head>

<body>


<nav>
  <a href="index.php"> Home </a>
  <a href="browse.php"> Browse </a>
  <a href="settings.php"> Settings </a>
  <a href="signup.php"> Sign up </a>
</nav>

<div class="browse-box box">
  <div class="filter-box">
    Meter type
    <ul>
      <li><input type="radio" name="Paystation" value="paystation">Paystation</li>
      <li><input type="radio" name="EV Station" value="evstation">EV charging station</li>
    </ul>
    Operation Hours
    <ul>
      <li><input type="radio" name="6to6" value="6am-6pm">6:00am - 6:00pm</li>
      <li><input type="radio" name="8to11" value="8am-11pm">8:00am - 11:00pm</li>
      <li><input type="radio" name="cityhours" value="cityhours">City Hall/Library Hours</li>
      <li><input type="radio" name="24hours" value="24hrs">24 hours </li>
    </ul>
    Operation Days
    <ul>
      <li><input type="radio" name="7days" value="7days">7 days a week</li>
      <li><input type="radio" name="Weekdays" value="weekdays">Weekdays</li>
    </ul>
    Hourly Rate
    <ul>
      <li>Rate slider</li>
    </ul>
    Daily Rate
    <ul>
      <li>Rate slider</li>
    </ul>
    Zone Type
    <ul>
      <li><input type="radio" name="OnStreet" value="onstreet">On-street</li>
      <li><input type="radio" name="Public" value="public">Public</li>
      <li><input type="radio" name="Employee" value="employee">Employee</li>
      <li><input type="radio" name="Underground" value="underground">Underground</li>
      <li><input type="radio" name="PavedOffStreet" value="pavedoffstreet">Surface Paved Off-street</li>
      <li><input type="radio" name="GravelOffStreet" value="graveloffstreet">Surface Gravel Off-street</li>
      <li><input type="radio" name="Fleet" value="fleet">Fleet</li>
    </ul>
    Payment Methods
    <ul>
      <li><input type="radio" name="Cash" value="cash">Cash</li>
      <li><input type="radio" name="CreditCard" value="credit">Credit Card</li>
      <li><input type="radio" name="PaybyPhone" value="paybyphone">Pay by Phone</li>
      <li><input type="radio" name="Invoice" value="invoice">Invoice</li>
    </ul>
  </div>

  <div class="items-box">
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>
    <div class="item"></div>

    <div class=" box pages-bar">
      <div class="prev"><</div>
      1
      <div class="next">></div>
    </div>

  </div>
</div>

</body>
</html>
