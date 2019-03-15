<?php
/**
 * @copyright GELIC - Gerenciamento De Licitação E Gestão De Resultados - LTDA (21.211.422/0001-86)
 * @version 0.9 RTM - (Realese To Manufacture)
 * @see Responsável pelo modelo VO de usuário padrão do sistema, independe de sua hierarquia ou perfil de acesso
 * @author Santos L. Victor
*/

class Usuario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @see Get usuario by id
     */
    function get_usuario($id)
    {
        return $this->db->get_where('usuarios',array('id'=>$id))->row_array();
    }

    /**
     * @author Santos M. Fabio - 26/12/2018
     * @see Seleciona o usuário de acordo o login e id, estando este ativo
     * @return array
     */
    function get_usuario_by_login_id($id, $email)
    {        
        return $this->db->get_where('usuarios',array('id'=>$id, 'email'=>$email, 'status ='=>'Ativo'))->row_array();
    } 
    

    /**
     * @see Get usuarios subordinados by id do responsavel
     */
    function get_usuario_sub($id_responsavel)
    {
        $query = "SELECT usuarios.id FROM usuarios "; 
        $query .= "WHERE id_responsavel = ". $id_responsavel ."";   
        $result = $this->db->query($query);
        return $result->result_array();
    }

    function info_logins_by_id()
    {
        $query = $this->db->query("SELECT 
                                        usu.login,
                                        usu.email,
                                        usu.nome,
                                        count(usu.login) as number_login                                      
                                    FROM
                                        usuarios usu                                        
                                    WHERE
                                        usu.login = '".$login."'
                                        GROUP BY
                                            usu.login
                                        HAVING
                                            COUNT(usu.login) > 1");
        $data = $query->result_array();
        return $data[0];
    } 

    /**
     * @see Get usuario by id
     */
    function get_usuario_sub_concessionaria($id_responsavel)
    {
        $query = "SELECT usuarios.id FROM usuarios "; 
        $query .= "WHERE usuarios.id_responsavel "; 
        $query .= "IN ( ";
        $query .= "SELECT usuarios.id FROM usuarios "; 
        $query .= "WHERE "; 
        $query .= "usuarios.id_responsavel IN(". $id_responsavel .") ";
        $query .= ") OR usuarios.id_responsavel = ". $id_responsavel ."";
        $result = $this->db->query($query);
        return $result->result_array();
    } 

    /**
     * @see Get usuario by id
     */
    function get_usuario_cliente($id)
    {
        $query = $this->db->query("SELECT 
                                        usu.id,
                                        usu.email as user_email,
                                        usu.login as user_login,
                                        usu.nome as user_nome,
                                        usu.telefone as user_telefone,
                                        usu.celular as user_celular,
                                        conce.id as id_conce,
                                        conce.nome_fantasia,
                                        conce.razao_social,
                                        conce.dn,
                                        conce.cnpj,
                                        usu.nome,
                                        conce.email,
                                        conce.telefone,
                                        usu.celular,
                                        conce.cep,
                                        conce.cidade,
                                        conce.uf,
                                        conce.regiao,
                                        conce.adve,
                                        conce.bairro,
                                        conce.rua,
                                        conce.numero,
                                        conce.complemento,
                                        usu.perfil,
                                        usu.login,
                                        conce.observacao,
                                        conce.inscricao_estadual,
                                        conce.grupo_economico,
                                        conce.site,
                                        conce.logo
                                    FROM
                                        usuarios usu
                                        LEFT JOIN
                                        concessionarias conce ON usu.id = conce.id_usuario
                                        LEFT JOIN
                                        metadatas data ON usu.id = data.id_usuario
                                    WHERE
                                        usu.id = '".$id."'
                                        AND
                                        usu.status <> 'Excluído'
                                        LIMIT 1;");
        $data = $query->result_array();
        return $data[0];
    }

    /**
     * @see Get usuario by id
     */
    function last_insert()
    {
        $query = $this->db->query("SELECT id FROM usuarios ORDER BY 1 DESC LIMIT 1;");
        return $query->row_array();
    }

    /**
     * @see Get usuario by email
     */
    function get_usuario_by_email($email)
    {
        return $this->db->get_where('usuarios',array('email'=>$email))->row_array();
    }    

    /**
     * @author Santos M. Fabio
     * @see Pega as informações do usuário pelo email 
     *      e verifica em qual dn ele esta atrelado
     * @return array
     */
    public function get_usuario_conce_by_email($email)
    {
        $query = $this->db->query("SELECT
                                        U.id, 
                                        U.email,
                                        C.id_concessionaria
                                    FROM
                                        usuarios as U
                                    INNER JOIN 
                                        users_concessionarias as C
                                        ON C.id_usuario = U.id
                                    WHERE
                                        U.email = '".$email."'
                                    AND
                                        U.status = 'Ativo'
                                    AND
                                        C.status = 'Ativo'");
        return $query->result_array();
    }

    /**
     * @see Get usuario by login and password -->deprecate
     */
    function get_usuario_by_login_senha($login, $senha)
    {
        return $this->db->get_where('usuarios',array('login'=>$login, 'senha'=>$senha, 'status !='=>'Excluído'))->row_array();
    }     
    
    /**
     * @author Santos M. Fabio - 03/01/2018
     * @see Get usuario by login and password
     * @return array
     */
    public function get_usuario_by_login_senha_first_or_default($login, $senha)
    {
        $query = $this->db->query("SELECT 
                                        count(id) 
                                    FROM 
                                        usuarios
                                    WHERE
                                        login = '".$login."'
                                        AND
                                        senha = '".$senha."'
                                    ORDER BY 
                                        id
                                    DESC LIMIT 1;");
        return $query->row_array();           
    }

     /**
     * @see Compares the email and password 
     *      contained in the database 
     *      with that provided by the user
     * @author Santos M. Fabio - 21/12/2018
     * @return boolean
     */
    function get_num_logins_users($login)
    {
        $query = "SELECT
                        user.id,
                        user.id_responsavel,
                        user.login,
                        user.nome,
                        user.email,
                        user.celular,
                        user.telefone,
                        user.senha,
                        user.perfil,
                        user.foto,
                        user.status,
                        user.ultimo_acesso,
                        user.situacao,
                        us_conc.id_concessionaria,
                        cons.nome_fantasia
                        FROM
                            usuarios as user
                        INNER JOIN
                            users_concessionarias as us_conc
                        ON
                            us_conc.id_usuario = user.id
                        INNER JOIN
                            concessionarias as cons
                        ON
                            cons.id = us_conc.id_concessionaria
                        WHERE
                            user.login = '".$login."'
                        AND 
                            user.status = 'Ativo'";
        $result = $this->db->query($query);                    
        $data = $result->result_array();        
        return $data;
    }



    function setSession($userId, $sessionId) {
        // $oldSessionId=$this->db->select("session_id")
        //                         ->where(array('userId'=>$userId))
        //                         ->get('sc_people')
        //                         ->row('session_id');
// die(__FILE__);
        // Destroy session which was mapped to previous user
        // $this->db->where('userId',array('id'=>$oldSessionId));
        // $this->db->delete('ci_sessions', $u_data);

        // Map new session ID to the user
        $this->db->where('userId',$userId);
        $this->db->update('ci_sessions',array('session_id'=>$session_id));
    }

   /**
     * @see Get all user ativo and perfil master by id responsavel
     */
    function get_usu_master_responsavel($id)
    {
        $query = $this->db->query("SELECT 
                                        user.*,
                                        conce.nome_fantasia
                                    FROM
                                        usuarios user
                                        LEFT JOIN
                                        users_concessionarias user_conce ON id_usuario = user.id
                                        LEFT JOIN
                                        concessionarias conce ON user_conce.id_concessionaria = conce.id OR conce.id_usuario = user.id
                                    WHERE
                                        user.id_responsavel = ".$id."
                                            AND user.perfil in ('Concessionária','Vendedor')
                                    ORDER BY user.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get usuario by login and password universal --> deprecate
     */
    function get_usuario_by_login($login)
    {
        return $this->db->get_where('usuarios',array('login'=>$login, 'status !='=>'Excluído'))->row_array();
    }

    /**
     * @see Get usuario by login and password universal, if user have more logins, this function will bring 
     * all users with this login
     */
    // function get_usuario_by_login($login)
    // {
    //     $query = $this->db->query("SELECT 
    //                                     user.* 
    //                                 FROM
    //                                     usuarios user
    //                                 WHERE   
    //                                     user.login = '".$login."'
    //                                     AND
    //                                     user.status != 'Excluído'     
    //                                 ORDER BY
    //                                     user.id
    //                                 LIMIT 1");        
    //     return $query->result_array();
    // }

    function get_info_users_by_login($login) 
    {
        return $login;
        $result = $this->db->query("SELECT 
                                        user.*, 
                                        count(user.login) AS num_users
                                    FROM 
                                        usuarios user
                                    WHERE
                                        user.login = '".$login."'
                                        AND
                                        user.status != 'Excluído'
                                        GROUP BY 
                                            user.login
                                        HAVING 
                                            COUNT(user.login)>1");
        return $result->result_array();
    }

    /**
    * @see Login de usuário a partir do id do usuário e id da concessionária a este atribuída
    */
    function get_usuario_by_ppk($id_concessionaria, $id_usuario) {
        $query = $this->db->query("SELECT 
                                        usu.*
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias usr ON usu.id = usr.id_usuario
                                            LEFT JOIN
                                        concessionarias conce ON conce.id = usr.id_concessionaria
                                    WHERE
                                        usu.status != 'Excluido'
                                        AND
                                        usu.id = ".$id_usuario."
                                        AND
                                        usr.id_usuario = ".$id_usuario."
                                        AND
                                        usr.id_concessionaria = ".$id_concessionaria."
                                        AND
                                        usr.status = 'Ativo'
                                        AND
                                        conce.status = 'Ativa'
                                    ORDER BY conce.dn ASC;");
        return $query->result_array();
    }

    /**
     * @see Get all user ativo by id responsavel
     */
    function get_all_clientes()
    {
        $query = $this->db->query("SELECT 
                                        usu.perfil,
                                        usu.id,
                                        usu.status,
                                        conce.dn,
                                        conce.nome_fantasia,
                                        conce.email,
                                        conce.telefone
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias usr ON usu.id = usr.id_usuario
                                            LEFT JOIN
                                        concessionarias conce ON conce.id = usr.id_concessionaria
                                    WHERE
                                        usu.status != 'Excluido'
                                            AND usu.perfil NOT IN ('Administrador' , 'Montadora', 'ASSOBRAV')
                                    ORDER BY conce.dn ASC;");
        return $query->result();
    }

    /**
     * @see Get all concessionarias ativas
     */
    function get_all_concessionarias()
    {
        $query = $this->db->query("SELECT 
                                        usu.perfil,
                                        usu.status,
                                        usu.id,
                                        usu.situacao, 
                                        conce.id as conce_id,
                                        conce.dn,
                                        conce.nome_fantasia,
                                        conce.email,
                                        conce.telefone,
                                        conce.regiao,
                                        (SELECT 
                                                num_usuarios 
                                            FROM
                                                financeiros 
                                            WHERE
                                                id_usuario = usu.id ORDER BY financeiros.id DESC limit 1) num_usuarios,
                                        (SELECT 
                                            value 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'cargo_funcao'
                                                AND
                                                metadatas.id_usuario = usu.id
                                            ORDER BY 1 desc LIMIT 1) as 'cargo',
                                        IFNULL(TIMESTAMPDIFF(SECOND, usu.ultimo_acesso, now()), 2) as 'time'
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias usr ON usu.id = usr.id_usuario
                                            LEFT JOIN
                                        concessionarias conce ON conce.id = usr.id_concessionaria
                                    WHERE
                                        usu.status != 'Excluído'
                                        AND
                                        conce.status != 'Excluída'
                                        AND usu.perfil = 'Concessionária'
                                    ORDER BY conce.dn ASC;");
        return $query->result();
    }

    /**
     * @see Get all concessionarias ativas
     */
    function get_user_concessionarias($id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usu.perfil,
                                        usu.nome,
                                        usu.status,
                                        usu.id,
                                        conce.id as conce_id,
                                        conce.dn,
                                        conce.nome_fantasia,
                                        conce.email,
                                        conce.telefone,
                                        conce.regiao,
                                        (SELECT 
                                            value 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'cargo_funcao'
                                                AND
                                                metadatas.id_usuario = usu.id
                                            ORDER BY 1 desc LIMIT 1) as 'cargo',
                                        IFNULL(TIMESTAMPDIFF(SECOND, usu.ultimo_acesso, now()), 2) as 'time'
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias usr ON usu.id = usr.id_usuario
                                            LEFT JOIN
                                        concessionarias conce ON conce.id = usr.id_concessionaria
                                    WHERE
                                        conce.id = '".$id_concessionaria."'
                                        AND
                                        usu.status != 'Excluído'
                                        AND
                                        conce.status != 'Excluída'
                                        AND usu.perfil = 'Concessionária'
                                    ORDER BY conce.dn ASC;");
        return $query->result();
    }

    /**
     * @see Get all concessionarias ativas
     */
    function get_all_user_concessionarias($id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usu.perfil,
                                        usu.nome,
                                        usu.status,
                                        usu.id,
                                        conce.id as conce_id,
                                        conce.dn,
                                        conce.nome_fantasia,
                                        conce.email,
                                        conce.telefone,
                                        conce.regiao,
                                        IFNULL(TIMESTAMPDIFF(SECOND, usu.ultimo_acesso, now()), 2) as 'time'
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias usr ON usu.id = usr.id_usuario
                                            LEFT JOIN
                                        concessionarias conce ON conce.id = usr.id_concessionaria
                                    WHERE
                                        conce.id = '".$id_concessionaria."'
                                        AND
                                        usu.status != 'Excluído'
                                        AND
                                        conce.status != 'Excluída'
                                    ORDER BY usu.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get all user ativo by id responsavel
     */
    function get_usu_by_responsavel($id)
    {
        $query = $this->db->query("SELECT 
                                        *
                                    FROM
                                        usuarios
                                    WHERE
                                        (id_responsavel = ".$id."
                                            OR
                                        id = ".$id.")
                                        AND
                                        status = 'Ativo'
                                        order by nome asc;");
        return $query->result();
    }

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function count_dn()
    {
        $query = $this->db->query("SELECT 
                                        count(id) as total
                                    FROM
                                        usuarios
                                    WHERE
                                        perfil not in ('Administrador','ASSOBRAV','Montadora')
                                        AND
                                        status <> 'Excluído';");
        $data = $query->result_array();
        return $data[0];
    }

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function count_usuarios()
    {
        $query = $this->db->query("SELECT 
                                        count(id) as total
                                    FROM
                                        usuarios
                                    WHERE
                                        perfil in ('Administrador','ASSOBRAV','Montadora')
                                        AND
                                        status <> 'Excluído';");
        $data = $query->result_array();
        return $data[0];
    }

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function count_logon()
    {


        $query = $this->db->query("SELECT 
                                        count(id) as total
                                    FROM
                                        usuarios
                                    WHERE
                                        situacao = 'Logon'
                                        AND
                                        status <> 'Excluído';");
        $data = $query->result_array();
        return $data[0];
    }  

    /** --> Deprecate
     * @see Conta o número de usuários de uma determinada concessionaria
     */
    function count_usuarios_conce($id_concessionaria)
    {        
        $query = $this->db->query("SELECT 
                                        count(usu.id) as total
                                    FROM
                                        users_concessionarias usu
                                        LEFT JOIN
                                        usuarios user ON usu.id_usuario = user.id
                                    WHERE
                                        usu.id_concessionaria = ".$id_concessionaria."
                                        AND
                                        user.status = 'Ativo'
                                        AND
                                        usu.status = 'Ativo';");
        $data = $query->result_array();
        return $data[0];
    }

    

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function update_logon($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('usuarios',array('ultimo_acesso' => date('Y-m-d H:i:s'), 'situacao' => 'Logon'));
    }

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function update_logout($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('usuarios',array('situacao' => 'Logout'));
    }

    /**
     * @see Get all user by perfil type concessionaria and responsavel id
     */
    function count_concessionaria($id)
    {
        $query = $this->db->query("SELECT 
                                        count(id) as total
                                    FROM
                                        usuarios
                                    WHERE
                                        perfil = 'Concessionária'
                                        AND
                                        id_responsavel = '".$id."';");
        $data = $query->result_array();
        return $data[0];
    }

    /**
     * @see Get all user ativo and perfil gerente by id responsavel and associated a concessionaria
     */
    function get_usu_gerente_responsavel_conce($id, $id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                    user.*, 
                                    conce.nome_fantasia,
                                    IFNULL(TIMESTAMPDIFF(SECOND, user.ultimo_acesso, now()), 2) as 'time'
                                    FROM
                                    usuarios user
                                        LEFT JOIN
                                    users_concessionarias conce_user ON conce_user.id_usuario = user.id
                                        LEFT JOIN
                                    concessionarias conce ON conce.id = conce_user.id_concessionaria
                                    WHERE
                                        user.id_responsavel = ".$id."
                                        AND user.status = 'Ativo'
                                        AND user.perfil = 'Vendedor'
                                        AND conce_user.id_concessionaria = '".$id_concessionaria."'
                                    ORDER BY user.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get all user ativo and perfil gerente by id responsavel
     */
    function get_usu_vendedor_responsavel($id)
    {
        $query = $this->db->query("SELECT 
                                    user.*, conce.nome_fantasia
                                    FROM
                                    usuarios user
                                        LEFT JOIN
                                    users_concessionarias conce_user ON conce_user.id_usuario = user.id
                                        LEFT JOIN
                                    concessionarias conce ON conce.id = conce_user.id_concessionaria
                                    WHERE
                                        user.id_responsavel = ".$id."
                                        AND user.status = 'Ativo'
                                        AND user.perfil = 'Vendedor'
                                    ORDER BY user.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get all user ativo and perfil montadora by id responsavel
     */
    function get_usu_gerente_responsavel($id)
    {
        $query = $this->db->query("SELECT 
                                    user.*
                                    FROM
                                    usuarios user
                                    WHERE
                                        user.id_responsavel = ".$id."
                                        AND user.status = 'Ativo'
                                    ORDER BY user.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get all user ativo and perfil montadora by id responsavel
     */
    function get_usuario_responsavel_gerente($id_dn, $id_usuario)
    {
        $query = $this->db->query("SELECT 
                                    user.*
                                    FROM
                                    usuarios user
                                    WHERE
                                            user.id_responsavel = ".$id_dn."
                                        AND 
                                            user.status = 'Ativo'
                                            AND 
                                            user.perfil = 'Gerente'
                                            AND  
                                            user.id != '".$id_usuario."'
                                    ORDER BY user.nome ASC;");
        return $query->result();
    }

    /**
     * @see Get all user ativo and perfil montadora by id responsavel
     */
    function get_gerentes_by_conce($id)
    {
        $query = $this->db->query("SELECT 
                                        usu.*
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias conc ON usu.id = conc.id_usuario
                                    WHERE
                                        conc.id_concessionaria = (select id_concessionaria from users_concessionarias where id_usuario=".$id.")
                                            AND usu.status = 'Ativo'
                                            AND usu.perfil = 'Gerente'
                                    ORDER BY usu.nome ASC;");
        return $query->result();
    }

    function get_gerentes_by_conce_to_update($id)
    {
        $query = $this->db->query("SELECT 
                                        usu.*
                                    FROM
                                        usuarios usu
                                            LEFT JOIN
                                        users_concessionarias conc 
                                            ON 
                                        usu.id = conc.id_usuario
                                    WHERE
                                        conc.id_concessionaria = (
                                                SELECT id_concessionaria 
                                                    FROM 
                                                        users_concessionarias 
                                                    WHERE 
                                                    id_usuario=".$id."
                                        )
                                            AND usu.status = 'Ativo'
                                            AND usu.perfil = 'Gerente'
                                            AND usu.id != ".$id."
                                    ORDER BY usu.nome ASC;");   

        return $query->result();
    }

    /**
     * @see Get all user ativo by responsavel or concessionaria
     */
    function get_user_by_user_id_conce($id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        conces.nome_fantasia
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        conce.id_concessionaria='".$id_concessionaria."' 
                                        AND conce.status = 'Ativo'
                                        AND usuario.perfil != 'Master'
                                        AND usuario.id != '".$_SESSION['id']."'
                                        order by nome asc;");        
        return $query->result();
    }

    /**
     * @see Get all user ativo by responsavel or concessionaria
     */
    function get_user_by_user_id($id_responsavel, $id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        conces.nome_fantasia
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        ( usuario.id_responsavel='".$id_responsavel."' OR (conce.id_concessionaria='".$id_concessionaria."' AND conce.status = 'Ativo') )
                                        AND
                                        usuario.id <> ".$id_responsavel."
                                        order by nome asc;");
        return $query->result();
    }

    /**
     * @see Get all gerente by concessionaria
     */
    function get_gerente_by_concessionaria($id_responsavel, $id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        conces.nome_fantasia
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        ( usuario.id_responsavel='".$id_responsavel."' OR (conce.id_concessionaria='".$id_concessionaria."' AND conce.status = 'Ativo') )
                                        AND
                                        usuario.id <> ".$id_responsavel."
                                        AND
                                        usuario.perfil = 'Gerente'
                                        order by nome asc;");
        return $query->result();
    }

    /**
     * @see Get all gerente by concessionaria
     */
    function get_usuario_conc($id_concessionaria)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        IFNULL(TIMESTAMPDIFF(SECOND, usuario.ultimo_acesso, now()), 2) as 'time',
                                        conces.nome_fantasia,
                                        (SELECT 
                                            id 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'controle_acesso'
                                                AND
                                                metadatas.id_usuario = usuario.id
                                            ORDER BY 1 desc LIMIT 1) as 'horario'
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        conces.id='".$id_concessionaria."'
                                        AND
                                        usuario.status <> 'Excluído'
                                        order by nome asc;");
        return $query->result();
    }

    /**
     * @see Get all gerente by concessionaria
     */
    function get_responsavel($id_responsavel)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        IFNULL(TIMESTAMPDIFF(SECOND, usuario.ultimo_acesso, now()), 2) as 'time',
                                        conces.nome_fantasia,
                                        (SELECT 
                                            id 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'controle_acesso'
                                                AND
                                                metadatas.id_usuario = usuario.id
                                            ORDER BY 1 desc LIMIT 1) as 'horario',
                                        (SELECT 
                                            value 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'cargo_funcao'
                                                AND
                                                metadatas.id_usuario = usuario.id
                                            ORDER BY 1 desc LIMIT 1) as 'cargo'
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        usuario.id_responsavel='".$id_responsavel."'
                                        AND
                                        usuario.id <> ".$id_responsavel."
                                        AND
                                        usuario.status <> 'Excluído'
                                        order by nome asc;");
        return $query->result();
    }


    /**
     * @see Get all gerente by concessionaria
     */
    function get_vendedores_by_concessionaria($id, $id_concessionaria, $id_responsavel)
    {
        $query = $this->db->query("SELECT 
                                        usuario.*,
                                        conces.nome_fantasia
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias conces ON conces.id = conce.id_concessionaria
                                    WHERE
                                        ( usuario.id_responsavel='".$id."' OR (conce.id_concessionaria='".$id_concessionaria."' AND conce.status = 'Ativo') )
                                        AND
                                        usuario.id <> ".$id."
                                        AND
                                        usuario.status <> 'Excluído'
                                        AND
                                        usuario.perfil = 'Vendedor'
                                        order by nome asc;");
        return $query->result();
    }

    /**
     * @see Get all user ativo by responsavel or concessionaria
     */
    function get_logo_by_user($id_usuario)
    {
        $query = $this->db->query("SELECT 
                                        conce.id_concessionaria,
                                        concessionaria.id,
                                        concessionaria.dn,
                                        concessionaria.nome_fantasia,
                                        concessionaria.logo
                                    FROM
                                        usuarios usuario
                                        LEFT JOIN
                                        users_concessionarias conce ON usuario.id = conce.id_usuario
                                        LEFT JOIN
                                        concessionarias concessionaria ON conce.id_concessionaria = concessionaria.id AND conce.status = 'Ativo'
                                    WHERE
                                        usuario.id = ".$id_usuario."
                                        AND
                                        conce.status = 'Ativo';");
        return $query->result();
    }

    /**
     * @see Get all usuarios
     */
    function get_all_usuarios()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('usuarios')->result_array();
    }


    /**
     * @see Get all user ativo and perfil master by id responsavel
     */
    function get_usuarios_array()
    {
        $query = $this->db->query("SELECT 
                                        usu.*,
                                        (SELECT 
                                            id 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'controle_acesso'
                                                AND
                                                metadatas.id_usuario = usu.id
                                            ORDER BY 1 desc LIMIT 1) as 'horario',
                                        (SELECT 
                                            value 
                                            FROM 
                                                metadatas
                                            WHERE
                                                chave = 'cargo_funcao'
                                                AND
                                                metadatas.id_usuario = usu.id
                                            ORDER BY 1 desc LIMIT 1) as 'cargo',
                                        IFNULL(TIMESTAMPDIFF(SECOND, usu.ultimo_acesso, now()), 2) as 'time'
                                    FROM
                                        usuarios usu
                                    WHERE
                                        usu.perfil in ('Administrador','ASSOBRAV','Montadora')
                                        ANd
                                        usu.status <> 'Excluído'
                                    ORDER BY FIELD(usu.perfil, 'Administrador' , 'ASSOBRAV', 'Montadora'), usu.nome ASC;");
        return $query->result();
    }
      
    /**
     * @see Get all user ativo and perfil master by id responsavel
     */
    function get_all_usuarios_array()
    {
        $query = $this->db->query("SELECT 
                                    user.*
                                FROM
                                    usuarios user
                                WHERE
                                    user.status <> 'Excluído'
                                ORDER BY nome ASC;");
        return $query->result();
    }

      
    /**
     * @see Get all user ativo and perfil conceccionária
     */
    function get_all_user_conce_array()
    {
        $query = $this->db->query("SELECT 
                                    user.login,
                                    user.id,
                                    conc.dn,
                                    conc.nome_fantasia
                                FROM
                                    usuarios user
                                    INNER JOIN
                                    concessionarias conc ON user.id = conc.id_usuario
                                WHERE
                                    user.perfil = 'Concessionária'
                                    AND
                                    conc.status = 'Ativa'
                                    AND
                                    user.status <> 'Excluído'
                                ORDER BY user.login ASC;");
        return $query->result();
    }

    /**
     * @see todos os usuario de uma concessionaria
     */
    function get_all_usuarios_by_conce($id_conce, $id_proprietario)
    {
        $query = $this->db->query("SELECT 
                                    user.*
                                FROM
                                    users_concessionarias conc
                                        LEFT JOIN
                                    usuarios user ON conc.id_usuario = user.id
                                WHERE
                                    conc.id_concessionaria = '".$id_conce."'
                                    ANd
                                    conc.id_usuario <> '".$id_proprietario."'
                                    AND
                                    user.status <> 'Excluído'
                                    AND
                                    conc.status = 'Ativo'
                                ORDER BY FIELD(user.perfil, 'Administrador' , 'ASSOBRAV', 'Montadora'), user.nome ASC;");
        return $query->result();
    }

    /**
     * @see function to add new usuario
     */
    function add_usuario($params)
    {
        $this->db->insert('usuarios',$params);
        return $this->db->insert_id();
    }
    
    /**
     * @see function to update usuario
     */
    function update_usuario($id,$params)
    {        
        $this->db->where('id',$id);
        return $this->db->update('usuarios',$params);
    }
    
    /**
     * @see function to delete usuario
     */
    function delete_usuario($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('usuarios',array('status' => 'Excluído'));
        // return $this->db->delete('usuarios',array('id'=>$id));
    }
}
