import java.sql.Connection; 
import java.sql.DriverManager; 
import java.sql.SQLException; 

// import java.io.IOException;
// import java.io.PrintWriter;
// import java.net.ServerSocket;
// import java.net.Socket;
// import java.util.ArrayList;
// import java.io.BufferedReader;
// import java.io.IOException;
// import java.io.InputStreamReader;




public class javaDB {
    
    // public static ArrayList<PrintWriter> m_OutputList;

     //접속자 정보 저장할 리스트 만들기
     // ArrayList<DataChatUser> clients;
     // DataChatUser uData;
    
     
     public static void main(String[] args) {
          // m_OutputList = new ArrayList<PrintWriter>();


          // try {
          //      ServerSocket s_socket = new ServerSocket(6137); //1.서버 소켓 포트번호 6173에 바인딩(I/O exception고려해 try-catch구문으로)
          //      System.out.println("ServerSocekt created!!!"); //서버소켓이 만들어짐.
   
               
          //   while(true){
          //        try {
          //           Socket c_socket = s_socket.accept(); //3.Listen for a connection 클라이언트 소켓을 서버 소켓 연결 
          //           System.out.println("conncet!!!");

          //           System.out.println("java DB!");
          //           Class.forName("com.mysql.jdbc.Driver"); //드라이버 로딩
     
          //           //드라이버 연결
          //           Connection con =  DriverManager.getConnection("jdbc:mysql://localhost/soo123","soo123","ksy9029");
          //           System.out.println("java DB connected!");

          //           ClientManagerThread c_thread = new ClientManagerThread();
          //           c_thread.setSocket(c_socket);
                    
          //           m_OutputList.add(new PrintWriter(c_socket.getOutputStream(),true));
          //           //getOutputStream으로 서버소켓과 연결된 클라이언트 소켓에 데이터를 보낸다.
          //           //PrintWriter를 사용하면 텍스트 형식으로 보낼 수 있다. 
          //           //서버에서 보낼 데이터를 텍스트 형식으로 list에 넣는다.
          //           //true 인수는 메소드 호출 후에 데이터 자동비우기 설정임.
     
          //           //System.out.println(m_OutputList.size()); //리스트를 프린트한다. 
          //           c_thread.start();
          //        } catch (Exception e) {
          //           System.out.println("java db fail");
          //           System.out.print("사유 : " + e.getMessage());
          //        }
              
              
          //  }//close while
               
          // } catch (Exception e) {
          //      System.out.println("Server exception : "+e.getMessage());
          //      e.printStackTrace();
          // }


          try{
              
               System.out.println("java DB!");
               Class.forName("com.mysql.jdbc.Driver"); //드라이버 로딩

               //드라이버 연결
               Connection con =  DriverManager.getConnection("jdbc:mysql://localhost/soo123","soo123","ksy9029");
               System.out.println("java DB connected!");
          }
          catch (Exception e){
               System.out.println("fail");
               System.out.print("사유 : " + e.getMessage());
          }


        
        } 

                        
                          
                        
                        
    }

