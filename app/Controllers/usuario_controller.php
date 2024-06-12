<?php
namespace App\Controllers;
Use App\Models\usuario_model;
use CodeIgniter\Controller;
use Config\Database; 
Use App\Models\perfiles_model;



class usuario_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);
    }
    
    public function create() {
        
        $data['titulo'] = 'Registrate - GalaxyGuitars';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/registro');
        echo view('Plantillas/footer');
    }
 
    public function formValidation() {
      $input = $this->validate([
          'nombre' => [
              'label' => 'nombre',
              'rules' => 'required|min_length[3]|max_length[50]',
              'errors' => [
                  'required' => 'El {field} es obligatorio.',
                  'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                  'max_length' => 'El {field} no puede exceder de {param} caracteres.',
              ]
          ],
          'apellido' => [
              'label' => 'apellido',
              'rules' => 'required|min_length[3]|max_length[50]',
              'errors' => [
                  'required' => 'El {field} es obligatorio.',
                  'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                  'max_length' => 'El {field} no puede exceder de {param} caracteres.',
              ]
          ],
          'nombre_usuario' => [
              'label' => 'nombre de usuario',
              'rules' => 'required|min_length[3]|max_length[50]|is_unique[usuario.nombre_usuario]',
              'errors' => [
                  'required' => 'El {field} es obligatorio.',
                  'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                  'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                  'is_unique' => 'El {field} ya está en uso.',
              ]
          ],
          'email' => [
              'label' => 'correo electrónico',
              'rules' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuario.email]',
              'errors' => [
                  'required' => 'El {field} es obligatorio.',
                  'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                  'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                  'valid_email' => 'El {field} debe contener un correo electrónico válido.',
                  'is_unique' => 'El {field} ya está registrado.',
              ]
          ],
          'pass' => [
              'label' => 'contraseña',
              'rules' => 'required|min_length[5]|max_length[20]',
              'errors' => [
                  'required' => 'La {field} es obligatoria.',
                  'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                  'max_length' => 'La {field} no puede exceder de {param} caracteres.',
              ]
          ],
      ]);

      $perfilIdCliente = $this->getPerfilIdCliente();
      $formModel = new Usuario_model();

      if (!$input) {
          $data['titulo'] = 'Registrate - GalaxyGuitars';
          echo view('Plantillas/encabezado', $data);
          echo view('Plantillas/registro', ['validation' => $this->validator]);
          echo view('Plantillas/footer');
      } else {
          $formModel->save([
              'nombre' => $this->request->getVar('nombre'),
              'apellido'=> $this->request->getVar('apellido'),
              'nombre_usuario'=> $this->request->getVar('nombre_usuario'),
              'email'=> $this->request->getVar('email'),
              'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
              'perfil_id' => $perfilIdCliente
          ]);  
           
          session()->setFlashdata('success', 'Usuario registrado con exito! Ahora por favor, inicia sesión.-');
          return redirect()->to('/login');
      }
  }


//aca entra cuando voy al CRUD USUARIOS en la barra de navegacion-----------------------------------------

public function cargar_crud($id = null) {
  $data['titulo'] = 'CRUD Usuarios';
  $v_usuarios_model = new usuario_model();
  $v_perfiles_model = new perfiles_model();

  // Obtener el término de búsqueda si existe
  $search = $this->request->getGet('search');

  if ($search) {
      $v_usuarios_model->like('nombre', $search);
      $v_usuarios_model->orLike('apellido', $search);
      $v_usuarios_model->orLike('nombre_usuario', $search);
  }

  $data['usuarios'] = $v_usuarios_model->findAll();
  $data['perfiles'] = $v_perfiles_model->findAll();

  echo view('Plantillas/encabezado', $data);
  echo view('Plantillas/crud_users', $data);
  echo view('Plantillas/footer');
}













    private function getPerfilIdCliente() {
        // Obtener una instancia del servicio Database
        $db = Database::connect();

        // Consultar el ID del perfil "Cliente" en la base de datos
        $perfilCliente = $db->table('perfiles')
                           ->where('descripcion', 'cliente')// para buscar la fila donde descripcion sea 'cliente'
                           ->get() //aca ejecuta la consulta
                           ->getRow(); //obtiene la primera fiera del resulado como un objeto
    
        // Verificar si se encontró el perfil "cliente"
        if ($perfilCliente) {
            return $perfilCliente->id_perfiles; //aca retornaria el id_perfiles, que es 1 o 2, dependiendo si es adm(1) o cliente(2)
        } else {
            // Si no se encuentra el perfil devolvemos null
            return null;
        }
    }


    //-----------------EDICION DE USUARIOS ------------------------------------------------
    //----------------- EL PROFE DIJO QUE NO ES NECESARIO (ver_editarUsuario), YA QUE EL ADMIN NO DEBE PODER EDITAR EL USUARIO-------------
  public function ver_editarUsuario($id = null) 
  {
    $data['titulo'] = 'Editar Usuario';
    $v_usuarios_model = new usuario_model();
    $data['usuario'] = $v_usuarios_model->where('id_usuario', $id)->first();

    $v_perfiles_model = new perfiles_model();
    $data['perfiles'] = $v_perfiles_model->findAll();

    echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_user');
        echo view('Plantillas/footer');
  }

  public function editarUsuario($id = null)
  {
    $input = $this->validate(
      [
        'nombre' => 'required|min_length[3]',
        'apellido' => 'required|min_length[3]|max_length[25]',
        'email' => 'required|min_length[4]|max_length[100]|valid_email',
      ],
    );

    $formModel = new usuario_model();

    $v_perfiles_model = new perfiles_model();
    //$data['perfiles'] = $v_perfiles_model->findAll();


    if (!$input) {
      $data['titulo'] = 'Error en editar usuario';
      echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/edit_user'), ['validation' => $this->validator,
        
        'usuario' => $formModel->where('id_usuario', $id)->first(),
        'perfiles' => $v_perfiles_model->findAll(),

      ];
      echo view('Plantillas/footer');
    } else {
      $array = ([
        'nombre' => $this->request->getVar('nombre'),
        'apellido' => $this->request->getVar('apellido'),
        'usuario' => $this->request->getVar('usuario'),
        'email' => $this->request->getVar('email'),
        'perfil_id' => $this->request->getVar('cod_tipo_usuario'),
      ]);

      
      $formModel->update($id, $array);
      return $this->response->redirect(base_url('/crud_usuarios'));

    }
    
  }


  public function eliminarUsuario($id = null)
  {
    $v_usuarioModel = new usuario_model();
    $data = [
      'baja' => "SI"
    ];
    $v_usuarioModel->update($id, $data);

    return $this->response->redirect(site_url('/crud_usuarios'));
  }
  public function restaurarUsuario($id = null)
  {
    $v_usuarioModel = new usuario_model();
    $data = [
      'baja' => "NO"
    ];
    $v_usuarioModel->update($id, $data);

    return $this->response->redirect(site_url('/crud_usuarios'));
  }


  public function ver_eliminados($id = null)
  {

    $data['titulo'] = 'Usuarios eliminados';
    $v_usuarios_model = new usuario_model();
    $data['usuarios'] = $v_usuarios_model->findAll();

    $v_perfiles_model = new perfiles_model();
    $data['perfiles'] = $v_perfiles_model->findAll();

    echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/users_eliminados', $data);
        echo view('Plantillas/footer');
  }
    
}