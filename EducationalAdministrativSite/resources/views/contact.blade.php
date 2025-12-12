@extends('layouts.app')

@section('content')

<!-- ============================= -->
<!--        CONTACT FORM           -->
<!-- ============================= -->
<div class="contact-wrapper">
    
    <!-- LEFT SIDE – FORM -->
    <div class="form-box">
        <form id="contactForm" class="contact-form">

            <table class="form-table">
                
                <!-- First & Last Name -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                        </div>
                    </td>
                </tr>
                

                <!-- Email & Phone -->
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                        </div>
                    </td>
                </tr>

                <!-- Course -->
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <select id="course" name="course" required>
                                <option value="">Select Course</option>
                                <option value="web-development">Web Development</option>
                                <option value="data-science">Data Science</option>
                                <option value="mobile-development">Mobile Development</option>
                                <option value="ui-ux-design">UI/UX Design</option>
                                <option value="digital-marketing">Digital Marketing</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <!-- Submit -->
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type="submit" class="submit-btn">Submit</button>
                    </td>
                </tr>

            </table>

        </form>
    </div>

    <!-- RIGHT SIDE – GOOGLE MAP -->
    <div class="map-box">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0771725917037!2d85.31879197446287!3d27.717245976187856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb190b7c746bbb%3A0x32f871e4b1cd5df2!2sKathmandu%20Durbar%20Square!5e0!3m2!1sen!2snp!4v1700000000000!5m2!1sen!2snp" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

</div>



  <!-- ============================= -->
  <!--       CONTACT CARDS           -->
  <!-- ============================= -->
  <section class="contact-section">
      <div class="contact-card">
        <h3>Accounts</h3>
        <p><span class="icon">✉️</span> accounts@theroseschool.edu.np</p>
        <p><span class="icon">📞</span> 9876543210</p>
        <p><span class="icon">⏰</span> 10:30 AM - 3:00 PM</p>
      </div>

      <div class="contact-card">
        <h3>Admissions</h3>
        <p><span class="icon">✉️</span> admissions@theroseschool.edu.np</p>
        <p><span class="icon">📞</span> 9784563210</p>
        <p><span class="icon">⏰</span> 10:00 AM - 3:00 PM</p>
      </div>

      <div class="contact-card">
        <h3>Student Service</h3>
        <p><span class="icon">✉️</span> ssd@theroseschool.edu.np</p>
        <p><span class="icon">📞</span> 9826235452</p>
        <p><span class="icon">📞</span> 9823458565</p>
        <p><span class="icon">📞</span> 9802135696</p>
        <p><span class="icon">⏰</span> 9:30 AM - 4:30 PM</p>
      </div>

    </div>
  </section>



  <!-- ============================= -->
  <!--        HOTLINE TABLE          -->
  <!-- ============================= -->
  <div class="container mt-5">
    <h1 class="title">Hotline Numbers</h1>

    <table class="hotline-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Designation</th>
          <th>Phone Number</th>
        </tr>
      </thead>

      <tbody>

        <!-- FINANCE -->
        <tr class="section-header"><td colspan="3">FINANCE</td></tr>
        <tr><td>Ram Raj Thapa</td><td>Deputy Finance Manager</td><td>9749678900</td></tr>
        <tr><td>Pramish Kafle</td><td>Group Finance Head</td><td>9804803050</td></tr>
        <tr><td>Prem Dhungel</td><td>Accounts Officer</td><td>9745781111</td></tr>

        <!-- IT -->
        <tr class="section-header"><td colspan="3">IT</td></tr>
        <tr><td>Shyam KC</td><td>Programme Leader</td><td>9700112233</td></tr>
        <tr><td>Rani Pandey</td><td>Programme Leader</td><td>9823547609</td></tr>
        <tr><td>Raju Thakur</td><td>Head of Subject</td><td>9818769955</td></tr>

        <!-- Business -->
        <tr class="section-header"><td colspan="3">Business</td></tr>
        <tr><td>Sita Tamang</td><td>Programme Leader</td><td>9824567890</td></tr>
        <tr><td>Sushanti Gole</td><td>Associate Programme Leader</td><td>9714356802</td></tr>

        <!-- Marketing -->
        <tr class="section-header"><td colspan="3">Marketing</td></tr>
        <tr><td>Aynnya Mojha</td><td>Asst. Marketing Manager</td><td>9801234567</td></tr>
        <tr><td>Anuj Jha</td><td>Head Marketing Manager</td><td>9802345678</td></tr>

        <!-- Admissions -->
        <tr class="section-header"><td colspan="3">Admissions</td></tr>
        <tr><td>Bikash Sharma</td><td>Head of Admissions</td><td>9836245696</td></tr>
        <tr><td>nirmal Shah</td><td>Admissions Supervisor</td><td>9825459685</td></tr>
        <tr><td>Bimala Gole</td><td>Senior Incharge</td><td>9803254569</td></tr>
        <tr><td>Tyla Limbu</td><td>Admissions Counsellor</td><td>9849458525</td></tr>

        <!-- SEO -->
        <tr class="section-header"><td colspan="3">SEO</td></tr>
        <tr><td>Pramila Shrestha</td><td>SEO Manager</td><td>9802345678</td></tr>
        <tr><td>Guru Dev</td><td>SEO Officer</td><td>9809876543</td></tr>

        <!-- Butwal IT -->
        <tr class="section-header"><td colspan="3">Butwal Unit, IT</td></tr>
        <tr><td>Paarson Sharma</td><td>Head of College</td><td>+01 3333333</td></tr>

        <!-- Kavre IT -->
        <tr class="section-header"><td colspan="3">Kavre Unit, IT</td></tr>
        <tr><td>Don Chaudary</td><td>Head of College</td><td>+01 2222222</td></tr>

        <!-- Jhapa -->
        <tr class="section-header"><td colspan="3">Jhapa Unit, IT</td></tr>
        <tr><td>Laxman Magar</td><td>Head of College</td><td>+01 7777777</td></tr>

      </tbody>
    </table>
  </div>

</div>

@endsection
