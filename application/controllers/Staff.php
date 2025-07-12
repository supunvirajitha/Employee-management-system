 <?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Staff extends CI_Controller
  {



    public function search()
    {
      // Get the search query from the form submission
      $search_query = $this->input->get('search');

      // Call the model method to search for staff
      $data['content'] = $this->staff_model->search_staff($search_query);
      $data['staff_data'] = $this->staff_model->search_staff($search_query);


      // Load your view with the search results
      $this->load->view('admin/header');
      $this->load->view('admin/manage-staff', $data);
      // $this->load->view('admin/staff-print', $data);
      $this->load->view('admin/footer');
    }


    function __construct()
    {
      parent::__construct();
      if (!$this->session->userdata('logged_in')) {
        redirect(base_url() . 'login');
      }
      $this->load->model('Staff_model');
      $this->load->model('staff_model');
    }

    public function index()
    {
      $data['department'] = $this->Department_model->select_departments();
      $data['country'] = $this->Home_model->select_countries();
      $this->load->view('admin/header');
      $this->load->view('admin/add-staff', $data);
      $this->load->view('admin/footer');
    }

    public function staff_print()
    {
      $data['content'] = $this->Staff_model->select_staff();
      $this->load->view('admin/header');
      $this->load->view('admin/staff-print', $data);
      $this->load->view('admin/footer');
    }

    public function manage()
    {
      $data['content'] = $this->Staff_model->select_staff();
      $this->load->view('admin/header');
      $this->load->view('admin/manage-staff', $data);
      $this->load->view('admin/footer');
    }

    public function insert()
    {
      $this->form_validation->set_rules('txtname', 'Full Name', 'required');
      $this->form_validation->set_rules('slcgender', 'Gender', 'required');
      $this->form_validation->set_rules('slcdepartment', 'Department', 'required');
      $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('txtmobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
      $this->form_validation->set_rules('txtdob', 'Date of Birth', 'required');
      $this->form_validation->set_rules('txtdoj', 'Date of Joining', 'required');
      $this->form_validation->set_rules('txtcity', 'City', 'required');
      $this->form_validation->set_rules('txtstate', 'State', 'required');
      $this->form_validation->set_rules('slccountry', 'Country');
      $this->form_validation->set_rules('intnic', 'nic', 'required');
      $this->form_validation->set_rules('txtepf', 'epf', 'required');
      $this->form_validation->set_rules('txtemployee_num', 'employee_num', 'required');
      // .
      //$this->form_validation->set_rules('txtduty', 'Duty');
      $this->form_validation->set_rules('txtremark', 'Remark');
      $this->form_validation->set_rules('slclanguage', 'language');
      $this->form_validation->set_rules('slcsdivision', 'sdivision');
      $this->form_validation->set_rules('slccivil', 'civil');
      $this->form_validation->set_rules('txtclitteracy', 'clitteracy');
      $this->form_validation->set_rules('txtol', 'ol');
      //$this->form_validation->set_rules('fileols', 'ols');
      $this->form_validation->set_rules('txtal', 'al');
      //$this->form_validation->set_rules('fileals', 'als');
      $this->form_validation->set_rules('txthq', 'hq');
      $this->form_validation->set_rules('txtpq', 'pq');
      $this->form_validation->set_rules('txtadditionaleducation', 'additionaleducation');
      //...\.
      $name = $this->input->post('txtname');
      $employee_num = $this->input->post('txtemployee_num');
      $gender = $this->input->post('slcgender');
      $department = $this->input->post('slcdepartment');
      $email = $this->input->post('txtemail');
      $mobile = $this->input->post('txtmobile');
      $dob = $this->input->post('txtdob');
      $doj = $this->input->post('txtdoj');
      $city = $this->input->post('txtcity');
      $state = $this->input->post('txtstate');
      $country = $this->input->post('slccountry');
      $address = $this->input->post('txtaddress');
      //.
      //$duty=$this->input->post('txtduty');
      $remark = $this->input->post('txtremark');
      $nic = $this->input->post('intnic');
      $epf = $this->input->post('txtepf');
      $language = $this->input->post('slclanguage');
      $sdivision = $this->input->post('slcsdivision');
      $civil = $this->input->post('slccivil');
      $clitteracy = $this->input->post('txtclitteracy');
      $ol = $this->input->post('txtol');
      //$ols=$this->input->post('fileols');
      $al = $this->input->post('txtal');
      //$als=$this->input->post('fileals');
      $hq = $this->input->post('txthq');
      $pq = $this->input->post('txtpq');
      $aq = $this->input->post('txtaq');
      $alstream = $this->input->post('txtalstream');
      //..\.
      $added = $this->session->userdata('userid');



      $login = $this->Home_model->insert_login(array('username' => $email, 'password' => $mobile, 'usertype' => 2));

      // echo $login;
      $id = $login;
      if ($this->form_validation->run() !== false) {

        $this->load->library('image_lib');
        $config['upload_path'] = 'uploads/staff_new/';

        $config['upload_path'] = 'uploads/staff/profile-pic/';

        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filephoto')) {
          $image = 'default-pic.jpg';
        } else {
          $image_data =   $this->upload->data();

          $configer =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer);
          $this->image_lib->resize();


          $image = $image_data['file_name'];

          $im = array(
            'staff_id' => $id,
            'type' => 1,
            'file_name' => $image
          );

          $this->Staff_model->insert_image($im);
        }

        // Load the Image Manipulation library
        $this->load->library('image_lib');
        $config2['upload_path'] = 'uploads/staff/duty';

        $config2['upload_path'] = 'uploads/staff_new/';

        $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config2, 'duty_upload'); // Load upload library for duty image with a different instance name ('duty_upload')

        if (!$this->duty_upload->do_upload('duty'))   //txtduty
        {
          $image2 = 'default-pic.jpg';
        } else {
          $image_data2 =   $this->duty_upload->data();

          $configer2 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data2['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer2);
          $this->image_lib->resize();

          $image2 = $image_data2['file_name'];


          $im2 = array(
            'staff_id' => $id,
            'type' => 2,
            'file_name' => $image2
          );

          $this->Staff_model->insert_image($im2);
        }




        $this->load->library('image_lib');
        $config3['upload_path'] = 'uploads/staff/ols/';

        $config3['upload_path'] = 'uploads/staff_new/';

        $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config3, 'ols_upload'); // Load upload library for ols image with a different instance name ('duty_upload')

        if (!$this->ols_upload->do_upload('ols'))   //txtols
        {
          $image3 = 'default-pic.jpg';
        } else {
          $image_data3 =   $this->ols_upload->data();

          $configer3 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data3['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer3);
          $this->image_lib->resize();

          $image3 = $image_data3['file_name'];

          $im3 = array(
            'staff_id' => $id,
            'type' => 3,
            'file_name' => $image3
          );

          $this->Staff_model->insert_image($im3);
        }




        $this->load->library('image_lib');
        $config4['upload_path'] = 'uploads/staff/als/';

        $config4['upload_path'] = 'uploads/staff_new/';

        $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config4, 'als_upload'); // Load upload library for als image with a different instance name ('duty_upload')

        if (!$this->als_upload->do_upload('als'))   //txtals
        {
          $image4 = 'default-pic.jpg';
        } else {
          $image_data4 =   $this->als_upload->data();

          $configer4 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data4['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer4);
          $this->image_lib->resize();

          $image4 = $image_data4['file_name'];

          $im4 = array(
            'staff_id' => $id,
            'type' => 4,
            'file_name' => $image4
          );

          $this->Staff_model->insert_image($im4);
        }

        $this->load->library('image_lib');
        $config5['upload_path'] = 'uploads/staff/idphotofront/';

        $config5['upload_path'] = 'uploads/staff_new/';

        $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config5, 'idphotofront_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->idphotofront_upload->do_upload('idphotofront'))   //txtidp
        {
          $image5 = 'default-pic.jpg';
        } else {
          $image_data5 =   $this->idphotofront_upload->data();

          $configer5 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data5['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer5);
          $this->image_lib->resize();

          $image5 = $image_data5['file_name'];

          $im5 = array(
            'staff_id' => $id,
            'type' => 5,
            'file_name' => $image5
          );

          $this->Staff_model->insert_image($im5);
        }

        $this->load->library('image_lib');
        $config6['upload_path'] = 'uploads/staff/bcardphoto/';

        $config6['upload_path'] = 'uploads/staff_new/';

        $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config6, 'bcardphoto_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->bcardphoto_upload->do_upload('bcardphoto'))   //txtidp
        {
          $image6 = 'default-pic.jpg';
        } else {
          $image_data6 =   $this->bcardphoto_upload->data();

          $configer6 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data6['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer6);
          $this->image_lib->resize();

          $image6 = $image_data6['file_name'];

          $im6 = array(
            'staff_id' => $id,
            'type' => 6,
            'file_name' => $image6
          );

          $this->Staff_model->insert_image($im6);
        }


        $this->load->library('image_lib');
        $config7['upload_path'] = 'uploads/staff/birthcertificate/';

        $config7['upload_path'] = 'uploads/staff_new/';

        $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config7, 'birthcertificate_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->birthcertificate_upload->do_upload('birthcertificate'))   //txtidp
        {
          $image7 = 'default-pic.jpg';
        } else {
          $image_data7 =   $this->birthcertificate_upload->data();

          $configer7 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data7['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer7);
          $this->image_lib->resize();

          $image7 = $image_data7['file_name'];

          $im7 = array(
            'staff_id' => $id,
            'type' => 7,
            'file_name' => $image7
          );

          $this->Staff_model->insert_image($im7);
        }


        $this->load->library('image_lib');
        $config8['upload_path'] = 'uploads/staff/leavingcertificate/';

        $config8['upload_path'] = 'uploads/staff_new/';

        $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config8, 'leavingcertificate_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->leavingcertificate_upload->do_upload('leavingcertificate'))   //txtidp
        {
          $image8 = 'default-pic.jpg';
        } else {
          $image_data8 =   $this->leavingcertificate_upload->data();

          $configer8 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data8['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer8);
          $this->image_lib->resize();

          $image8 = $image_data8['file_name'];

          $im8 = array(
            'staff_id' => $id,
            'type' => 8,
            'file_name' => $image8
          );

          $this->Staff_model->insert_image($im8);
        }


        $this->load->library('image_lib');
        $config9['upload_path'] = 'uploads/staff/highereducationqualification/';

        $config9['upload_path'] = 'uploads/staff_new/';

        $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config9, 'highereducationqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->highereducationqualification_upload->do_upload('highereducationqualification'))   //txtidp
        {
          $image9 = 'default-pic.jpg';
        } else {
          $image_data9 =   $this->highereducationqualification_upload->data();

          $configer9 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data9['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer9);
          $this->image_lib->resize();

          $image9 = $image_data9['file_name'];

          $im9 = array(
            'staff_id' => $id,
            'type' => 9,
            'file_name' => $image9
          );

          $this->Staff_model->insert_image($im9);
        }


        $this->load->library('image_lib');
        $config10['upload_path'] = 'uploads/staff/profesionalqualification/';

        $config10['upload_path'] = 'uploads/staff_new/';

        $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config10, 'profesionalqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->profesionalqualification_upload->do_upload('profesionalqualification'))   //txtidp
        {
          $image10 = 'default-pic.jpg';
        } else {
          $image_data10 =   $this->profesionalqualification_upload->data();

          $configer10 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data10['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer10);
          $this->image_lib->resize();

          $image10 = $image_data10['file_name'];

          $im10 = array(
            'staff_id' => $id,
            'type' => 10,
            'file_name' => $image10
          );

          $this->Staff_model->insert_image($im10);
        }


        $this->load->library('image_lib');
        $config11['upload_path'] = 'uploads/staff/additionalqualification/';

        $config11['upload_path'] = 'uploads/staff_new/';

        $config11['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config11, 'additionalqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->additionalqualification_upload->do_upload('additionalqualification'))   //txtidp
        {
          $image11 = 'default-pic.jpg';
        } else {
          $image_data11 =   $this->additionalqualification_upload->data();

          $configer11 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data11['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer11);
          $this->image_lib->resize();

          $image11 = $image_data11['file_name'];

          $im11 = array(
            'staff_id' => $id,
            'type' => 11,
            'file_name' => $image11
          );

          $this->Staff_model->insert_image($im11);
        }



        $this->load->library('image_lib');
        $config12['upload_path'] = 'uploads/staff/appointmentletter/';
        $config12['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config12, 'appointmentletter_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->appointmentletter_upload->do_upload('appointmentletter'))   //txtidp
        {
          $image12 = 'default-pic.jpg';
        } else {
          $image_data12 =   $this->appointmentletter_upload->data();

          $configer12 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data12['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer12);
          $this->image_lib->resize();

          $image12 = $image_data12['file_name'];
        }



        $this->load->library('image_lib');
        $config13['upload_path'] = 'uploads/staff/professionalmembership/';
        $config13['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $this->load->library('upload', $config13, 'professionalmembership_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        if (!$this->professionalmembership_upload->do_upload('professionalmembership'))   //txtidp
        {
          $image13 = 'default-pic.jpg';
        } else {
          $image_data13 =   $this->professionalmembership_upload->data();

          $configer13 =  array(
            'image_library'   => 'gd2',
            'source_image'    =>  $image_data13['full_path'],
            'maintain_ratio'  =>  TRUE,
            'width'           =>  150,
            'height'          =>  150,
            'quality'         =>  50
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($configer13);
          $this->image_lib->resize();

          $image13 = $image_data13['file_name'];
        }


        // $login = $this->Home_model->insert_login(array('username' => $email, 'password' => $mobile, 'usertype' => 2));

        if ($login > 0) {
          // echo "haa";
          $data = $this->Staff_model->insert_staff(array('id' => $login, 'staff_name' => $name, 'gender' => $gender, 'email' => $email, 'mobile' => $mobile, 'dob' => $dob, 'doj' => $doj, 'address' => $address, 'city' => $city, 'state' => $state, 'country' => $country, 'department_id' => $department, 'pic' => $image, 'added_by' => $added, 'remark' => $remark, 'duty' => $image2, 'nic' => $nic, 'idphotofront' => $image5, 'bcardphoto' => $image6, 'epf' => $epf, 'language' => $language, 'sdivision' => $sdivision, 'civil' => $civil, 'clitteracy' => $clitteracy, 'ol' => $ol, 'al' => $al, 'ols' => $image3, 'als' => $image4, 'hq' => $hq, 'pq' => $pq, 'aq' => $aq, 'employee_num' => $employee_num, 'birthcertificate' => $image7, 'leavingcertificate' => $image8, 'alstream' => $alstream, 'highereducationqualification' => $image9, 'profesionalqualification' => $image10, 'additionalqualification' => $image11, 'appointmentletter' => $image12, 'professionalmembership' => $image13)); //'als'=>$image4,'ols'=>$image3,
        }
        // echo $data;
        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', "New Staff Added Succesfully");
        } else {
          $this->session->set_flashdata('error', "Sorry, New Staff Adding Failed.");
        }

        // if ($data == true) {

        //   $this->session->set_flashdata('success', "New Staff Added Succesfully");
        // } else {
        //   $this->session->set_flashdata('error', "Sorry, New Staff Adding Failed.");
        // }
        redirect($_SERVER['HTTP_REFERER']);
      } else {
        $this->index();
        return false;
      }
    }


    public function update()
    {
      $this->load->helper('form');
      $this->form_validation->set_rules('txtname', 'Full Name', 'required');
      $this->form_validation->set_rules('slcgender', 'Gender', 'required');
      $this->form_validation->set_rules('slcdepartment', 'Department', 'required');
      $this->form_validation->set_rules('txtemail', 'Email', 'trim|required|valid_email');
      // $this->form_validation->set_rules('txtmobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{9}$/]');
      $this->form_validation->set_rules('txtdob', 'Date of Birth', 'required');
      $this->form_validation->set_rules('txtdoj', 'Date of Joining', 'required');
      $this->form_validation->set_rules('txtcity', 'City', 'required');
      $this->form_validation->set_rules('txtstate', 'State', 'required');
      $this->form_validation->set_rules('slccountry', 'Country', 'required');
      $this->form_validation->set_rules('txtemployee_num', 'employee_num', 'required');
      $this->form_validation->set_rules('txtremark', 'Remark');
      $this->form_validation->set_rules('intnic', 'NIC');
      $this->form_validation->set_rules('txtepf', 'EPF');
      $this->form_validation->set_rules('slclanguage', 'Language');
      $this->form_validation->set_rules('slcsdivision', 'SDivision');
      $this->form_validation->set_rules('slccivil', 'Civil');
      $this->form_validation->set_rules('txtclitteracy', 'Clitteracy');
      $this->form_validation->set_rules('txtol', 'ol');
      $this->form_validation->set_rules('ols', 'ols');
      $this->form_validation->set_rules('als', 'als');
      $this->form_validation->set_rules('txtal', 'al');
      $this->form_validation->set_rules('txthq', 'hq');
      $this->form_validation->set_rules('txtpq', 'pq');

      $id = $this->input->post('txtid');
      $employee_num = $this->input->post('txtemployee_num');
      $name = $this->input->post('txtname');
      $gender = $this->input->post('slcgender');
      $department = $this->input->post('slcdepartment');
      $email = $this->input->post('txtemail');
      $mobile = $this->input->post('txtmobile');
      $dob = $this->input->post('txtdob');
      $doj = $this->input->post('txtdoj');
      $city = $this->input->post('txtcity');
      $state = $this->input->post('txtstate');
      $country = $this->input->post('slccountry');
      $address = $this->input->post('txtaddress');
      $remark = $this->input->post('txtremark');
      $nic = $this->input->post('intnic');
      $epf = $this->input->post('txtepf');
      $language = $this->input->post('slclanguage');
      $sdivision = $this->input->post('slcsdivision');
      $civil = $this->input->post('slccivil');
      $clitteracy = $this->input->post('txtclitteracy');
      $ol = $this->input->post('txtol');
      $ols = $this->input->post('ols');
      $al = $this->input->post('txtal');
      $als = $this->input->post('als');
      $hq = $this->input->post('txthq');
      $pq = $this->input->post('txtpq');
      $aq = $this->input->post('txtaq');
      $alstream = $this->input->post('txtalstream');

      if ($this->form_validation->run() !== false) {
        // $this->load->library('image_lib');
        // $config['upload_path'] = 'uploads/staff/profile-pic/';
        // $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('filephoto')) {
        //   $image = 'default-pic.jpg';
        // } else {
        //   $image_data = $this->upload->data();

        //   $configer = array(
        //     'image_library' => 'gd2',
        //     'source_image' => $image_data['full_path'],
        //     'maintain_ratio' => TRUE,
        //     'width' => 150,
        //     'height' => 150,
        //     'quality' => 50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer);
        //   $this->image_lib->resize();

        //   $image = $image_data['file_name'];
        // }



        // $this->load->library('image_lib');
        // $config2['upload_path'] = 'uploads/staff/duty/';
        // $config2['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config2, 'duty_upload');

        // if (!$this->duty_upload->do_upload('duty')) {
        //   $image2 = 'default-pic.jpg';
        // } else {
        //   $image_data2 = $this->duty_upload->data();

        //   $configer2 = array(
        //     'image_library' => 'gd2',
        //     'source_image' => $image_data2['full_path'],
        //     'maintain_ratio' => TRUE,
        //     'width' => 150,
        //     'height' => 150,
        //     'quality' => 50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer2);
        //   $this->image_lib->resize();

        //   $image2 = $image_data2['file_name'];
        // }

        // $this->load->library('image_lib');
        // $config3['upload_path'] = 'uploads/staff/ols/';
        // $config3['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config3, 'ols_upload'); // Load upload library for ols image with a different instance name ('duty_upload')

        // if (!$this->ols_upload->do_upload('ols'))   //txtols
        // {
        //   $image3 = 'default-pic.jpg';
        // } else {
        //   $image_data3 =   $this->ols_upload->data();

        //   $configer3 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data3['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer3);
        //   $this->image_lib->resize();

        //   $image3 = $image_data3['file_name'];
        // }


        // $this->load->library('image_lib');
        // $config4['upload_path'] = 'uploads/staff/als/';
        // $config4['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config4, 'als_upload'); // Load upload library for als image with a different instance name ('duty_upload')

        // if (!$this->als_upload->do_upload('als'))   //txtals
        // {
        //   $image4 = 'default-pic.jpg';
        // } else {
        //   $image_data4 =   $this->als_upload->data();

        //   $configer4 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data4['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer4);
        //   $this->image_lib->resize();

        //   $image4 = $image_data4['file_name'];
        // }





        // $this->load->library('image_lib');
        // $config5['upload_path'] = 'uploads/staff/idphotofront/';
        // $config5['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config5, 'idphotofront_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->idphotofront_upload->do_upload('idphotofront'))   //txtidp
        // {
        //   $image5 = 'default-pic.jpg';
        // } else {
        //   $image_data5 =   $this->idphotofront_upload->data();

        //   $configer5 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data5['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer5);
        //   $this->image_lib->resize();

        //   $image5 = $image_data5['file_name'];
        // }

        // $this->load->library('image_lib');
        // $config6['upload_path'] = 'uploads/staff/bcardphoto/';
        // $config6['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config6, 'bcardphoto_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->bcardphoto_upload->do_upload('bcardphoto'))   //txtidp
        // {
        //   $image6 = 'default-pic.jpg';
        // } else {
        //   $image_data6 =   $this->bcardphoto_upload->data();

        //   $configer6 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data6['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer6);
        //   $this->image_lib->resize();

        //   $image6 = $image_data6['file_name'];
        // }



        // $this->load->library('image_lib');
        // $config7['upload_path'] = 'uploads/staff/birthcertificate/';
        // $config7['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config7, 'birthcertificate_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->birthcertificate_upload->do_upload('birthcertificate'))   //txtidp
        // {
        //   $image7 = 'default-pic.jpg';
        // } else {
        //   $image_data7 =   $this->birthcertificate_upload->data();

        //   $configer7 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data7['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer7);
        //   $this->image_lib->resize();

        //   $image7 = $image_data7['file_name'];
        // }


        // $this->load->library('image_lib');
        // $config8['upload_path'] = 'uploads/staff/leavingcertificate/';
        // $config8['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config8, 'leavingcertificate_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->leavingcertificate_upload->do_upload('leavingcertificate'))   //txtidp
        // {
        //   $image8 = 'default-pic.jpg';
        // } else {
        //   $image_data8 =   $this->leavingcertificate_upload->data();

        //   $configer8 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data8['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer8);
        //   $this->image_lib->resize();

        //   $image8 = $image_data8['file_name'];
        // }





        // $this->load->library('image_lib');
        // $config9['upload_path'] = 'uploads/staff/highereducationqualification/';
        // $config9['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config9, 'highereducationqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->highereducationqualification_upload->do_upload('highereducationqualification'))   //txtidp
        // {
        //   $image9 = 'default-pic.jpg';
        // } else {
        //   $image_data9 =   $this->highereducationqualification_upload->data();

        //   $configer9 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data9['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer9);
        //   $this->image_lib->resize();

        //   $image9 = $image_data9['file_name'];
        // }


        // $this->load->library('image_lib');
        // $config10['upload_path'] = 'uploads/staff/profesionalqualification/';
        // $config10['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config10, 'profesionalqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->profesionalqualification_upload->do_upload('profesionalqualification'))   //txtidp
        // {
        //   $image10 = 'default-pic.jpg';
        // } else {
        //   $image_data10 =   $this->profesionalqualification_upload->data();

        //   $configer10 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data10['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer10);
        //   $this->image_lib->resize();

        //   $image10 = $image_data10['file_name'];
        // }


        // $this->load->library('image_lib');
        // $config11['upload_path'] = 'uploads/staff/additionalqualification/';
        // $config11['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        // $this->load->library('upload', $config11, 'additionalqualification_upload'); // Load upload library for idpimage with a different instance name ('duty_upload')

        // if (!$this->additionalqualification_upload->do_upload('additionalqualification'))   //txtidp
        // {
        //   $image11 = 'default-pic.jpg';
        // } else {
        //   $image_data11 =   $this->additionalqualification_upload->data();

        //   $configer11 =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data11['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  150,
        //     'height'          =>  150,
        //     'quality'         =>  50
        //   );
        //   $this->image_lib->clear();
        //   $this->image_lib->initialize($configer11);
        //   $this->image_lib->resize();

        //   $image11 = $image_data11['file_name'];
        // }

        $images = $this->input->post('image');


        if (is_array($images) && count($images) > 0) {
          $this->Staff_model->delete_image($id);

          foreach ($images as $i => $image_group) {
            foreach ($image_group as $image) {
              $im = array(
                'staff_id' => $id,
                'type' => $i,
                'file_name' => $image
              );
              $this->Staff_model->insert_image($im);
            }
          }
        }

        // $this->Staff_model->delete_image($id);
        // for ($i = 1; $i <= count($images); $i++) {
        //   foreach ($images[$i] as $image) {
        //     $im = array(
        //       'staff_id' => $id,
        //       'type' => $i,
        //       'file_name' => $image
        //     );

        //     $this->Staff_model->insert_image($im);
        //   }
        // }



        $data = $this->Staff_model->update_staff(array(
          'staff_name' => $name,
          'gender' => $gender,
          'email' => $email,
          // 'mobile' => $mobile,
          'dob' => $dob,
          'doj' => $doj,
          'address' => $address,
          'city' => $city,
          'state' => $state,
          'country' => $country,
          'department_id' => $department,
          // 'pic' => $image,
          // 'added_by' => $added,
          'remark' => $remark,
          'nic' => $nic,
          'epf' => $epf,
          // 'duty' => $image2,
          'ol' => $ol,
          // 'ols' => $image3,
          'al' => $al,
          // 'als' => $image4,
          'language' => $language,
          'sdivision' => $sdivision,
          'civil' => $civil,
          'clitteracy' => $clitteracy,
          'hq' => $hq,
          'pq' => $pq,
          // 'idphotofront' => $image5,
          // 'bcardphoto' => $image6,
          'employee_num' => $employee_num,
          'alstream' => $alstream,
          // 'birthcertificate' => $image7,
          // 'leavingcertificate' => $image8,
          // 'highereducationqualification' => $image9,
          // 'profesionalqualification' => $image10,
          // 'additionalqualification' => $image11
        ), $id);

        // if ($this->db->affected_rows() > 0) {
        // $this->session->set_flashdata('success', $images);
        $this->session->set_flashdata('success', "Staff Updated Successfully");
        // } else {
        // $this->session->set_flashdata('error', "Sorry, Staff Update Failed.");
        // }
        redirect(base_url() . "manage-staff");
      } else {
        $this->index();
        return false;
      }
    }



    function edit($id)
    {
      $data['department'] = $this->Department_model->select_departments();
      $data['country'] = $this->Home_model->select_countries();
      $data['content'] = $this->Staff_model->select_staff_byID($id);
      $data['images'] = $this->Staff_model->get_staff_imgs($id);
      $this->load->view('admin/header');
      $this->load->view('admin/edit-staff', $data);
      $this->load->view('admin/footer');
      // print_r($data['images']);
    }


    function delete($id)
    {
      $this->Home_model->delete_login_byID($id);
      $data = $this->Staff_model->delete_staff($id);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', "Staff Deleted Succesfully");
      } else {
        $this->session->set_flashdata('error', "Sorry, Staff Delete Failed.");
      }
      redirect($_SERVER['HTTP_REFERER']);
    }
    public function upload_image()
    {
      $config['upload_path']          = './uploads/staff_new';
      $config['allowed_types']        = 'gif|jpg|png';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('Upload_image')) {
        $error = array('error' => $this->upload->display_errors());
        $dat['Status'] = 1;
        echo json_encode($data);
      } else {
        $data = $this->upload->data();

        $dat['Status'] = 2;
        $dat['FileName'] = $this->upload->data('file_name');
        echo json_encode($dat);
      }
    }
  }
