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
                </br> </br> </br> </br> </br> </br>

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
    <div class="contact-grid">

      <div class="contact-card">
        <h3>IT Assistance & Support</h3>
        <p><span class="icon">📞</span> 9805687511</p>
        <p><span class="icon">⏰</span> 6:30 AM - 6:00 PM</p>
      </div>

      <div class="contact-card">
        <h3>Accounts</h3>
        <p><span class="icon">✉️</span> accounts@thebritishcollege.edu.np</p>
        <p><span class="icon">📞</span> 9704541903</p>
        <p><span class="icon">⏰</span> 9:30 AM - 5:00 PM</p>
      </div>

      <div class="contact-card">
        <h3>Admissions</h3>
        <p><span class="icon">✉️</span> admissions@thebritishcollege.edu.np</p>
        <p><span class="icon">📞</span> 9802343228</p>
        <p><span class="icon">⏰</span> 9:30 AM - 5:00 PM</p>
      </div>

      <div class="contact-card">
        <h3>A Levels</h3>
        <p><span class="icon">📞</span> 9801134338</p>
      </div>

      <div class="contact-card">
        <h3>PTE</h3>
        <p><span class="icon">📞</span> 9803466327</p>
      </div>

      <div class="contact-card">
        <h3>Student Service</h3>
        <p><span class="icon">✉️</span> ssd@thebritishcollege.edu.np</p>
        <p><span class="icon">📞</span> 9823046328</p>
        <p><span class="icon">📞</span> 9823041013</p>
        <p><span class="icon">📞</span> 9801314205</p>
        <p><span class="icon">⏰</span> 9:30 AM - 5:00 PM</p>
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
        <tr><td>Rajan Kumar Adhikari</td><td>Deputy Finance Manager</td><td>9700867743</td></tr>
        <tr><td>Ambika Kafle</td><td>Group Finance Head</td><td>9804848858</td></tr>
        <tr><td>Bindu Dhungel</td><td>Accounts Officer</td><td>9745678633</td></tr>

        <!-- IT -->
        <tr class="section-header"><td colspan="3">IT</td></tr>
        <tr><td>Saroj Sharma</td><td>Programme Leader</td><td>9700867736</td></tr>
        <tr><td>Jyoti Gautam Pant</td><td>Programme Leader</td><td></td></tr>
        <tr><td>Rohit Raj Pandey</td><td>Head of Subject</td><td>9804047752</td></tr>

        <!-- Business -->
        <tr class="section-header"><td colspan="3">Business</td></tr>
        <tr><td>Gokul Bista</td><td>Programme Leader</td><td>9849812377</td></tr>
        <tr><td>Rahul Poude</td><td>Associate Programme Leader</td><td>9845468847</td></tr>

        <!-- Marketing -->
        <tr class="section-header"><td colspan="3">Marketing</td></tr>
        <tr><td>Anushree Mashal</td><td>AGO (Admissions & Marketing)</td><td>9801962012</td></tr>
        <tr><td>Anil Ojha</td><td>Asst. Marketing Manager</td><td>9801962012</td></tr>

        <!-- Admissions -->
        <tr class="section-header"><td colspan="3">Admissions</td></tr>
        <tr><td>Dhiraj Pradhan Rai</td><td>Head of Admissions and Outreach</td><td>9842058640</td></tr>
        <tr><td>Babita Paudel</td><td>Admissions Supervisor</td><td>9851804710</td></tr>
        <tr><td>Sumit Bhandana</td><td>Senior Incharge</td><td>9802343238</td></tr>
        <tr><td>Nancy Rajbhandari</td><td>Admissions Counsellor</td><td>9849234095</td></tr>

        <!-- SEO -->
        <tr class="section-header"><td colspan="3">SEO</td></tr>
        <tr><td>Krishna Shrestha</td><td>SEO Manager</td><td>9801534206</td></tr>
        <tr><td>Diya Kandel</td><td>SEO Officer</td><td>9801534206</td></tr>

        <!-- BPC/ACCA -->
        <tr class="section-header"><td colspan="3">BPC/ACCA</td></tr>
        <tr><td>Dipendra Shrestha</td><td></td><td>9801544383, 9851808018</td></tr>

        <!-- Pokhara A Levels -->
        <tr class="section-header"><td colspan="3">Pokhara Unit, A Levels</td></tr>
        <tr><td>Purbasaa Dhakal</td><td></td><td>9700866824, 9851047159</td></tr>

        <!-- Pokhara ACCA -->
        <tr class="section-header"><td colspan="3">Pokhara Unit, ACCA</td></tr>
        <tr><td>Pokhara Unit, ACCA</td><td></td><td>9851858440</td></tr>

        <!-- BMC/A Levels -->
        <tr class="section-header"><td colspan="3">BMC / A Levels</td></tr>
        <tr><td>Rajan Kumar Rai</td><td>Head of School, BEG</td><td>9821443243, 9851856550</td></tr>

      </tbody>
    </table>
  </div>

</div>

@endsection
