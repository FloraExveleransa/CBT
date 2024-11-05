<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_lelang;


class Home extends BaseController
{
	public function Login()
	{
        $model= new M_lelang();
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);

    echo view('Login', $data);
	}
    
    public function setting()
           {
            $userLevel = session()->get('Level');
            $allowedLevels = ['admin'];
            $user_id = session()->get('id_user');
            if (in_array($userLevel, $allowedLevels)) {
               $model = new M_lelang();

               $logoData = $model->tampil('logo'); // Fetch all logos
               $filteredLogo = array_filter($logoData, function($item) {
                   return $item->id_logo == 1; // Adjust this condition as needed
               });
               $data['satu'] = reset($filteredLogo);
               $where = array('id_logo' => $id);
               $data['sa'] = $model->getwhere('logo', $where);
               $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

        $model->logActivity($user_id, 'View', 'User view Setting.');
               echo view('header', $data);
               echo view('menu', $data);
               echo view('setting', $data);
               echo view('footer');
            } else {
                return redirect()->to('home/notfound');
            }
           }
           public function aksi_setting()
           {
               $model = new M_lelang();
               $user_id = session()->get('id_user');
               $a = $this->request->getPost('nama');
               $icon = $this->request->getFile('image2');
               $dash = $this->request->getFile('image');

           
               // Debugging: Log received data
               log_message('debug', 'Website Name: ' . $a);
               log_message('debug', 'Tab Icon: ' . ($icon ? $icon->getName() : 'None'));
               log_message('debug', 'Dashboard Icon: ' . ($dash ? $dash->getName() : 'None'));
           
               $data = ['nama_logo' => $a];
               $uploadPath = ROOTPATH . 'public/assets/img/custom/';
           
               if ($icon && $icon->isValid() && !$icon->hasMoved()) {
                   if (!file_exists($uploadPath . $icon->getName())) {
                       $icon->move($uploadPath, $icon->getName());
                   }
                   $data['icon'] = $icon->getName();
               }
           
               if ($dash && $dash->isValid() && !$dash->hasMoved()) {
                   if (!file_exists($uploadPath . $dash->getName())) {
                       $dash->move($uploadPath, $dash->getName());
                   }
                   $data['logos'] = $dash->getName();
               }
           
           
               $where = ['id_logo' => 1];
               $model->logActivity($user_id, 'Updated', 'User Has Updated The Logo');
               $model->edit('logo', $data, $where);
           
               return redirect()->to('setting/1');
           }
	public function aksi_login() {
        $user_id = session()->get('id_user');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $backupCaptcha = $this->request->getPost('backup_captcha');
    
        // Check if the server is online
       
        $model = new M_lelang();
            $where = array(
                'user' => $username,
                'password' => $password
            );
        
            $cek = $model->getWhere('user', $where);
        if ($cek > 0) {
                    session()->set('user', $cek->username);
                    session()->set('id_user', $cek->id_user);
                    session()->set('Level', $cek->Level);
                    $model->logActivity($user_id, 'Login', 'User Has Log in.');
                    return redirect()->to('Site');
                } else {
                    return redirect()->to('login');
                }
    }
  
   
    public function admin()
    {
        $userLevel = session()->get('Level');
            $allowedLevels = ['admin'];
        
            if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
    
    $data['s'] = $model->tampil('user', 'id_user');
    $model->logActivity($user_id, 'View', 'User view Admin Menu.');
     echo view('header', $data);
    echo view('menu',$data);
    echo view('admin',$data);
    echo view('footer');
    } else {
        return redirect()->to('notfound');
    }
    }
    public function siswa()
    {
        $userLevel = session()->get('Level');
            $allowedLevels = ['admin'];
        
            if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
    
    $data['s'] = $model->tampil('user', 'id_user');
    $model->logActivity($user_id, 'View', 'User view Siswa Menu.');
     echo view('header', $data);
    echo view('menu',$data);
    echo view('siswa',$data);
    echo view('footer');
    } else {
        return redirect()->to('notfound');
    }
    }
    public function guru()
    {
        $userLevel = session()->get('Level');
            $allowedLevels = ['admin'];
        
            if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
    
    $data['s'] = $model->tampil('user', 'id_user');
    $model->logActivity($user_id, 'View', 'User view Guru Menu.');
     echo view('header', $data);
    echo view('menu',$data);
    echo view('guru',$data);
    echo view('footer');
    } else {
        return redirect()->to('notfound');
    }
    }
    
	public function logout() {
        $user_id = session()->get('id_user');

            // Log the logout activity
            $model = new M_lelang();        
            $model->logActivity($user_id, 'Logout', 'User Has Logout.');
        session()->destroy();
        return redirect()->to('http://localhost:8080/home');
    }
    
    
public function t_user()
{
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin'];
    $user_id = session()->get('id_user');
    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $model->logActivity($user_id, 'View', 'User view Add User.');
        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_user');
        echo view('footer');
    } else {
        return redirect()->to('home/notfound');
    }
}
public function aksi_t_user()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
        $user_id = session()->get('id_user');
        if (in_array($userLevel, $allowedLevels)) {
            $model = new M_lelang(); // Assuming you instantiate the model like this
           
            $a = $this->request->getPost('level');
            $b = $this->request->getPost('NIS');
            $b = $this->request->getPost('nama');
            $c = $this->request->getPost('username');
            $d = $this->request->getPost('level1');
            
            // Set password based on level
            if ($d == 'admin') {
                $password = md5("admin");
            } elseif ($d == 'guru') {
                $password = md5("guru");
            } elseif ($d == 'Siswa') {
                $password = md5("Siswa"); // Example password for manager
            } else {
                $password = md5("default137"); // Default password if level is not recognized
            }
    
            $isi = array(
                'pelajaran' => $a,
                'NIS' => $b,
                'user' => $c,
                'Level' => $d,
                'password' => $password,
                'real' => $c,
            );
    
            // Print the data for debugging purposes
            // print_r($isi);
    
            // Perform the insert operation
         
            $model->tambah('user', $isi);
            $model->logActivity($user_id, 'Add', 'User add user.');
            // Redirect to the desired page
            return redirect()->to('t_user');
        } else {
            return redirect()->to('notfound');
        }
    }
    public function calender()
{
    $model = new M_lelang();
    
    // Fetch user data
    $where = array('id_user' => session()->get('id_user'));
    $data['user'] = $model->getWhere('user', $where);
    $user_id = session()->get('id_user');
    // Fetch logo data
    $logoData = $model->tampil('logo'); 
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    
    // Fetch events from the 'soal' table
    $data['events'] = $this->getEvents();
    $model->logActivity($user_id, 'View', 'User view Calender.');
    echo view('header', $data);
    echo view('menu', $data);
    echo view('calender', $data); // Ensure the view file name matches
    echo view('footer');
}

// Method to fetch events from the 'soal' table
// Method to fetch events from the 'soal' table
private function getEvents()
{
    $model = new M_lelang();
    $events = $model->tampil('soal'); // Fetch events from 'soal'
    $eventData = [];

    foreach ($events as $event) {
        // Ensure Waktu and title are not empty
        if (!empty($event->Waktu) && !empty($event->title)) {
            // Store the title indexed by the Waktu
            $eventData[$event->Waktu] = $event->title; // Adjust based on your table structure
        }
    }

    return $eventData; // Return associative array of dates and titles
}
public function Site()
{
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin', 'siswa','guru'];

    if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
    
        $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
            $model->logActivity($user_id, 'View', 'User view Dashboard.');
        $data['s'] = $model->tampil('pelajaran', 'id_pelajaran');
        echo view('header');
        echo view('menu', $data);
        return view('Site', $data);
    } else {
        return redirect()->to('lol');
    }
}
public function activity_log()
{
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin'];

    if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
    
        $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
        $logs = $model->getActivityLogs();
        $data['s'] = $model->tampil('user', 'id_user');
        $data['logs'] = $logs;
        $model->logActivity($user_id, 'View', 'User view Activity Log.');
        echo view('header');
        echo view('menu', $data);
        return view('activity_log', $data);
    } else {
        return redirect()->to('http://localhost:8080/home/error_404');
    }
}
public function PagePelajaran($id) {
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin', 'siswa','guru'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');

        // Fetch logo data and filter for id_logo = 1
        $logoData = $model->tampil('logo');
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo); // Store logo data in $data['logo']

        // Fetch pelajaran data based on the passed $id
        $where = array('id_pelajaran' => $id);
        $data['pelajaran'] = $model->getWhere('pelajaran', $where);

        // Fetch user data
        $where = array('id_user' => session()->get('id_user'));
        $data['user'] = $model->getWhere('user', $where);

        // Log activity for user viewing the exam page
        $model->logActivity($user_id, 'View', 'User viewed the Exam Page.');

        // Load views with $data
        echo view('header', $data);
        echo view('menu', $data);
        echo view('Page', $data); // Make sure 'Page' view uses $pelajaran data properly
        echo view('footer');
    } else {
        // Redirect to not found page if user level is not allowed
        return redirect()->to('home/notfound');
    }
}
public function PageUjian($id) {
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin', 'siswa','guru'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');

        // Fetch logo data and filter for id_logo = 1
        $logoData = $model->tampil('logo');
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo); // Store logo data in $data['logo']

        // Fetch pelajaran data based on the passed $id

        $data['pelajaran'] = $model->getWhere('pelajaran', ['id_pelajaran' => $id]);


        $data['Soal'] = $model->tampil('Soal');
        $where = array('id_user' => session()->get('id_user'));
        $data['user'] = $model->getWhere('user', $where);

        // Log activity for user viewing the exam page
        $model->logActivity($user_id, 'View', 'User Review the Exam test.');

        // Load views with $data
        echo view('header', $data);
        echo view('menu', $data);
        echo view('SoalS', $data); // Make sure 'Page' view uses $pelajaran data properly
        echo view('footer');
    } else {
        // Redirect to not found page if user level is not allowed
        return redirect()->to('home/notfound');
    }
}
public function nilai()
{
    $model = new M_lelang();
    
    // Get the 'nilai' value from the POST request, not as a file
    $nilai = $this->request->getPost('nilai');
    $id= $this->request->getPost('id');
    // Prepare data for updating
    $isi = array('nilai' => $nilai);
    
    // Condition for update
    $where = array('id_pelajaran' => $id);
    
    // Call the edit function from the model
    $model->edit('pelajaran', $isi, $where);
    
    // For debugging
    print_r($isi);
    print_r($where );
    
    // Redirect to PageUjian with the id parameter
    return redirect()->to('PageUjian/' . $id);
}
public function PageUjianB($id) {
    $userLevel = session()->get('Level');
    $allowedLevels = ['admin', 'siswa'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');

        // Fetch logo data and filter for id_logo = 1
        $logoData = $model->tampil('logo');
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo); // Store logo data in $data['logo']

        // Fetch pelajaran data based on the passed $id

        $data['pelajaran'] = $model->getWhere('pelajaran', ['id_pelajaran' => $id]);


        $data['Soal'] = $model->tampil('Soal');
        $where = array('id_user' => session()->get('id_user'));
        $data['user'] = $model->getWhere('user', $where);

        // Log activity for user viewing the exam page
        $model->logActivity($user_id, 'View', 'User is Doing the Exam.');

        // Load views with $data
        echo view('header', $data);
        echo view('menu', $data);
        echo view('SoalB', $data); // Make sure 'Page' view uses $pelajaran data properly
        echo view('footer');
    } else {
        // Redirect to not found page if user level is not allowed
        return redirect()->to('home/notfound');
    }
}
public function jawaban()
{
    $model = new M_lelang();
    
    // Get the 'nilai' value from the POST request, not as a file
    $answer = $this->request->getPost('answer');
    $id= $this->request->getPost('id');
    $ids= $this->request->getPost('ids');
    // Prepare data for updating
    $isi = array('JWB' => $answer,
                 'selesai' => 'Selesai');
    
    // Condition for update
    $where = array('id_soal' => $id);
    $where2 = array('id_pelajaran' => $ids);
    // Call the edit function from the model
    $model->edit('soal', $isi, $where);
    
    // For debugging
    print_r($isi);
    print_r($where );
    print_r($where2 );
    
//     // // Redirect to PageUjian with the id parameter
    return redirect()->to('PageUjianB/' . $ids);
}
public function selesai()
{
    $model = new M_lelang();
    $user_id = session()->get('id_user');
    // Get the 'nilai' value from the POST request, not as a file
    $id= $this->request->getPost('id');
    // Prepare data for updating
    $isi = array('Selesai' => "Selesai");
    
    // Condition for update
    $where = array('id_pelajaran' => $id);
    
    // Call the edit function from the model
    $model->edit('pelajaran', $isi, $where);
    
    // For debugging
    print_r($isi);
    print_r($where );
    
    $model->logActivity($user_id, 'Exam', 'User Has finished the Exam.');

    // Redirect to PageUjian with the id parameter
    return redirect()->to('PagePelajaran/' . $id);
}
public function PageUjianG($id) {
    $userLevel = session()->get('Level');
    $allowedLevels = ['guru'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');

        // Fetch logo data and filter for id_logo = 1
        $logoData = $model->tampil('logo');
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo); // Store logo data in $data['logo']

        // Fetch pelajaran data based on the passed $id

        $data['pelajaran'] = $model->getWhere('pelajaran', ['id_pelajaran' => $id]);


        $data['Soal'] = $model->tampil('Soal');
        $where = array('id_user' => session()->get('id_user'));
        $data['user'] = $model->getWhere('user', $where);

        // Log activity for user viewing the exam page
        $model->logActivity($user_id, 'View', 'User View The add Exam.');

        // Load views with $data
        echo view('header', $data);
        echo view('menu', $data);
        echo view('SoalG', $data); // Make sure 'Page' view uses $pelajaran data properly
        echo view('footer');
    } else {
        // Redirect to not found page if user level is not allowed
        return redirect()->to('home/notfound');
    }
}
public function t_soal()
{
    $model = new M_lelang();
    $user_id = session()->get('id_user');
    $id= $this->request->getPost('id');
    $a= $this->request->getPost('pilihan_a');
    $b= $this->request->getPost('pilihan_b');
    $c= $this->request->getPost('pilihan_c');
    $d= $this->request->getPost('pilihan_d');
    $e= $this->request->getPost('pilihan_e');
    $soal= $this->request->getPost('soal');
    $JWB= $this->request->getPost('JWB');
    $no= $this->request->getPost('no');
    $pelajaran= $this->request->getPost('pelajaran');
    $Kelas= $this->request->getPost('kelas');
    $blok= $this->request->getPost('blok');
   
    // Prepare data for updating
    $isi = array('pilihan_A' => $a,
                 'pilihan_B' => $b,
                 'pilihan_C' => $c,
                 'pilihan_D' => $d,
                 'pilihan_E' => $e,
                 'pelajaran' => $pelajaran,
                 'kelas' => $Kelas,
                 'blok' => $blok,
                 'no' => $no,
                 'JWBenar' => $JWB,
                 'soal' => $soal,
                 'selesai' => "Belum",);
                 
    
    // Condition for update
    
    // Call the edit function from the model
    $model->tambah('soal', $isi, $where);
    
    // For debugging
    print_r($isi);
    print_r($where );
    
    $model->logActivity($user_id, 'Exam', 'User Has add Exam Question.');

    // Redirect to PageUjian with the id parameter
    return redirect()->to('PageUjianG/' . $id);
}
}
