import java.sql.Connection; 
import java.sql.DriverManager; 
import java.sql.SQLException; 
public class javaDB {
    
     private Connection con;

     
      public javaDB() { 
          try {
        Class.forName("com.mysql.jdbc.Driver");
        con= DriverManager.getConnection("jdbc:mysql://52.79.204.252/soo123","soo123","ksy9029");
    //            String url = "jdbc:mysql://localhost/soo123";
    //             String user = "soo123"; 
    //             String passwd = "ksy9029";
    //              con = DriverManager.getConnection(url, user, passwd);
                  con.close();
                   System.out.println("DB연결 성공"); 
                } catch (SQLException e) {
                     System.out.println("DB연결 실패");
                      System.out.print("사유 : " + e.getMessage()); } } 
                      public static void main(String[] args) {
                           new javaDB();
                         } 
    
                        
                          
                        
                        
    }

