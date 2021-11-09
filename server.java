// import java.net.*;
// import java.io.*;

// public class server{
//     public static void main(String[] args){

//         try{
          
//             ServerSocket ss = new ServerSocket(8888);

//             Socket s = ss.accept();
//             // System.out.println("server start");

//             OutputStream output_data = s.getOutputStream();

//             String data = "welcome to server";
//             output_data.write(data.getBytes());

//             ss.close();
//             s.close();

//         // InputStreamReader in = new InputStreamReader(s.getInputStream());
//         // BufferedReader bf = new BufferedReader(in);

//         // String str = bf.readLine();
//         // System.out.println("client : " +str);
    
//         }catch (Exception e){
//             e.printStackTrace();
                    
//         }
       
        
        
//     }


// }