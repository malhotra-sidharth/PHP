# googleAuth-internshipDemo

<h2>Table of Contents</h2>
<ul>
  <li><a href="#intro">Introduction</a></li>
  <li><a href="#require">Requirements</a></li>
  <li><a href="#work">Requests & Responses</a></li>
  <li><a href="#author">Author</a></li>
  <li><a href="#license">License</a></li>
</ul>

<a name="intro"></a>
<h2>Introduction</h2>
This is a small demo project to illustrate the use of Google Firebase to authenticate users and Show them nearby logged in users from their city in ascending order.

<a name="require"></a>
<h2>Requirements</h2>
<ul>
  <li><a href="https://firebase.google.com/">Google Firebase</a></li>
  <li><a href="https://developers.google.com/maps/documentation/distance-matrix/">Google Distance Matrix</a></li>
  <li><a href="http://www.geoplugin.com/">GeoPlugin</a></li>
</ul>


<a name="work"></a>
<h2>Requests & Responses</h2>
<ul>
  <li>Asks user for his/her Gmail email & password. Using firebase authentication API, if the user has a verified email the system logs him in else error is shown on the screen.</li>
  <li>Once user logs in, his latitude and longitude coordinates and city is received via geoplugin API.</li>
  <li>User's Name, Latitude & Longutude Coordinates and his city are updated every time user logs in and these are used to find the other logged in users who are nearby the current user (within the same city) and are displayed in ascending order.</li>
</ul>


<a name="author"></a>
<h2>Author</h2>
<h4>Developed by Sidharth Malhotra</h4>

<a name="license"></a>
<h2>License</h2>
Code released under the <a href="https://github.com/sidharth0094/googleAuth-internshipDemo/blob/master/LICENSE">MIT license.</a>
