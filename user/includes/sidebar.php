 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3">
     <nav class="navbar bg-light navbar-light">
         <a href="index.html" class="navbar-brand mx-4 mb-3">
             <h3 class="text-primary">CBK-Dash</h3>
         </a>
         <div class="d-flex align-items-center ms-4 mb-4">
             <div class="position-relative">
                 <!-- <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> -->
                 <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
             </div>
             <div class="ms-3">
                 <h6 class="mb-0 text-info">Admin</h6>
             </div>
         </div>
         <div class="navbar-nav w-100">
             <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>डैशबोर्ड</a>
           <!-- For Swekshanudan -->
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>स्वेच्छानुदान</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../swekshanudan/swekshanudan.php" class="dropdown-item"><b>नया आवेदन</b></a>
                     <a href="../swekshanudan/aavedak.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../swekshanudan/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../swekshanudan/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../swekshanudan/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../swekshanudan/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
<!-- For nirmaan  -->
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>निर्माण</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../nirmaan/new_nirmaan.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nirmaan/nirmaan_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../nirmaan/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../nirmaan/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../nirmaan/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../nirmaan/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
             <!-- For चिकित्सा अनुदान -->
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>चिकित्सा अनुदान</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- For aavedan -->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>आवेदन</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- For स्थानातरण -->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>स्थानातरण</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- For स्थानातरण -->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>प्रोटोकॉल</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- For आमंत्रण-->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>आमंत्रण</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- For चर्चा-->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>चर्चा</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
                   <!-- रिपोर्ट-->
                   <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>रिपोर्ट </a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../chikitsa/new_chikitsa.php" class="dropdown-item"><b>नया आवेदन जोड़ें </b></a>
                     <a href="../nchikitsa/chikitsa_aavedan.php" class="dropdown-item"><b>प्राप्त आवेदन</b></a> 
                     <a href="../chikitsa/prastavit_aavedan.php" class="dropdown-item"><b>प्रस्तावित आवेदन</b></a>
                     <a href="../chikitsa/sveekrt_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन</b></a>
                     <a href="../chikitsa/presit_aavedan.php" class="dropdown-item"><b>स्वीकृत आवेदन ( प्रेषित )</b></a>
                     <a href="../chikitsa/asveekrt_aavedan.php" class="dropdown-item"><b>अस्वीकृत आवेदन</b></a>
                 </div>
             </div>
<!-- मास्टर सेटिंग्स -->
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-cog me-2"></i>मास्टर टेबल सेटिंग्स</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../master/district_master.php" class="dropdown-item">डिस्ट्रिक्ट मास्टर</a>
                     <a href="../master/vidhansabha_master.php" class="dropdown-item">विधानसभा मास्टर</a>
                     <a href="../master/vikaskhand_master.php" class="dropdown-item">विकासखंड मास्टर</a>
                     <a href="../master/sector_master.php" class="dropdown-item">सेक्टर मास्टर</a>
                     <a href="../master/gram_panchayat_master.php" class="dropdown-item">ग्राम पंचायत मास्टर</a>
                     <a href="../master/gram_master.php" class="dropdown-item">ग्राम मास्टर</a>
                     <a href="../master/yojana_master.php" class="dropdown-item">योजना मास्टर</a>
                     <a href="../master/vibhag_master.php" class="dropdown-item">विभाग मास्टर</a>
                     <a href="../master/maananeey_master.php" class="dropdown-item">माननीय मास्टर</a>
                 </div>
             </div>
             <!-- सेटिंग्स -->
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-cog me-2"></i>सेटिंग्स</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="../master/district_master.php" class="dropdown-item">डिस्ट्रिक्ट मास्टर</a>
                     <a href="../master/vidhansabha_master.php" class="dropdown-item">विधानसभा मास्टर</a>
                     <a href="../master/vikaskhand_master.php" class="dropdown-item">विकासखंड मास्टर</a>
                     <a href="../master/sector_master.php" class="dropdown-item">सेक्टर मास्टर</a>
                     <a href="../master/gram_panchayat_master.php" class="dropdown-item">ग्राम पंचायत मास्टर</a>
                     <a href="../master/gram_master.php" class="dropdown-item">ग्राम मास्टर</a>
                     <a href="../master/yojana_master.php" class="dropdown-item">योजना मास्टर</a>
                     <a href="../master/vibhag_master.php" class="dropdown-item">विभाग मास्टर</a>
                     <a href="../master/maananeey_master.php" class="dropdown-item">माननीय मास्टर</a>
                 </div>
             </div>
             <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
             <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
             <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
             <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="signin.html" class="dropdown-item">Sign In</a>
                     <a href="signup.html" class="dropdown-item">Sign Up</a>
                     <a href="404.html" class="dropdown-item">404 Error</a>
                     <a href="blank.html" class="dropdown-item">Blank Page</a>
                 </div>
             </div>
             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="signin.html" class="dropdown-item">Sign In</a>
                     <a href="signup.html" class="dropdown-item">Sign Up</a>
                     <a href="404.html" class="dropdown-item">404 Error</a>
                     <a href="blank.html" class="dropdown-item">Blank Page</a>
                 </div>
             </div>

         </div>
     </nav>
 </div>
 <!-- Sidebar End -->