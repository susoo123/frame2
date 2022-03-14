import java.sql.Connection; 
import java.sql.DriverManager; 
import java.sql.SQLException; 
import java.sql.PreparedStatement;

// import java.net.ServerSocket;
// import java.net.Socket;

import java.sql.*;
import java.io.*;
import java.util.*;
import java.net.*;

//import java.util.ArrayList;
//import java.io.PrintWriter;

//import java.util.List;

// import org.json.simple.JSONObject;
// import org.json.simple.parser.JSONParser;
// import org.json.simple.parser.ParseException;
// //JSON배열 사용

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonObject;
import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonParser;


// import java.io.BufferedReader;
// import java.io.IOException;
// import java.io.InputStreamReader;
// import java.io.OutputStream;

//import java.io.charset.StandardCharsets;
//import java.io.InputStream;


//서버 소켓 
//1. 서버 소켓 생성, 포트 바인딩
//2. 클라이언트로부터의 연결을 기다리다가 요청이 오면 수락
//3. 클라이언트 소켓에서 가져온 InputStream(클라이언트 쪽에서는 OuputStream)을 읽음
//4. 응답이 있다면 OutputStream을 통해 클라이언트에 데이터를 보냄
//5. 클라이언트와의 연결을 닫음
//6. 서버 종료





public class chatServer{
   //public static ArrayList<PrintWriter> m_OutputList;
   // private static JSONArray arr;
   // private static JSONObject data;
   private static JsonObject jsonObject;
   private static JsonObject jsonObject2;
   private static JsonArray jsonArray;
   private static ArrayList<String> list = new ArrayList<>();
   private static Connection con;
   private static ResultSet rs ;
   private static  Statement st;
   private static JsonArray clientInfoArray;
   private static String user_id, receiver_id, room_id, RECEIVER_ID,type;
   private static PrintWriter writer;
   private static HashMap<String, PrintWriter> hashMap;
   private static HashMap<String, PrintWriter> m_OutputList;
   private static HashMap<String, HashMap<String, PrintWriter>> allUsers;

   //사용자들의 정보를 저장할 맵 
   private static Map<String,DataOutputStream> clientsMap = new HashMap<String,DataOutputStream>();

//    private static HashMap<String,DataOutputStream> clients;
//    chatServer(){
//        clients = new HashMap<>();
//        Collections.synchronizedMap(clients);
//    }

// public void setting() throws IOException {
//     Collections.synchronizedMap(clientsMap); //교통정리??
    
    
// }

// public void sendMsg(String msg) {
//     lterator<String> it = clientsMap.keySet().iterator();
//     String key="";
//     while(it.hasNext()){
//         key = it.next();
//         try{
//           clientsMap.get(key).writerUTF(msg);

//         }catch (Exception e){
//           e.printStackTrace();          
//         }
                
//     }
    
// }
  
   

    public static void main(String[] args) {
        Gson gson = new Gson();
     
        m_OutputList = new  HashMap<String, PrintWriter>();

      

        try{

            //Collections.synchronizedMap(clientsMap); 
            //1.서버 소켓을 만든다.
            ServerSocket s_socket = new ServerSocket(6137);

            //2. 해시맵을 선언한다. <user_id, printwriter>
           // hashMap = new HashMap<String, PrintWriter>(); //hashMap객체를 생성해서 hm 변수에 대입
           

           // while(true){
                   
                try{

                    
				// while(true)
				// {
				// 	Socket c_socket = s_socket.accept();
				// 	ClientManagerThread c_thread = new ClientManagerThread();
				// 	c_thread.setSocket(c_socket);
					
				// 	m_OutputList.add(new PrintWriter(c_socket.getOutputStream()));
					
				// 	c_thread.start();
				// }
                while(true)
				{
                
                   //3. 소켓을 만들어 클라이언트소켓 연결을 기다림. 
                   Socket socket = s_socket.accept();
                 
                   InputStream inputStream = socket.getInputStream();
            
                    InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
                    
                    BufferedReader in = new BufferedReader(inputStreamReader);
                    writer = new PrintWriter(socket.getOutputStream());

                    user_id = in.readLine();
                    //m_OutputList.put(user_id, new PrintWriter(socket.getOutputStream(),true));
                    m_OutputList.put(user_id, writer);
                    System.out.println("m_OutputList : "+m_OutputList.toString());
                    
                    System.out.println("user_id 스트림 : " +  m_OutputList.get(user_id) + "\n");
                    
                    m_OutputList.get(user_id).flush();//보내는 사람에게 보내기
                    System.out.println(" 확인0 " + "\n");

                    
                  
////////////////////////////////////////////////
                //    while(true) {
                //     Socket socketUser = serverSocket.accept(); // 서버에 클라이언트 접속 시
                //     // Thread 안에 클라이언트 정보를 담아줌
                //     Thread thd = new MySocketServer(socketUser);
                //     thd.start(); // Thread 시작
                //         }        

                //     //3-1. 모든 유저의 소켓이 저장은 되어야함.     
                //    list.add(new PrintWriter(socket.getOutputStream()));
                //    System.out.println("list : "+ list);
  ////////////////////////////////////////////////////////                 
                    


                //4. jdbc 연결 
                    System.out.println("jdbc");
                    Class.forName("com.mysql.cj.jdbc.Driver"); //드라이버 로딩

                    //드라이버 연결
                    con =  DriverManager.getConnection("jdbc:mysql://localhost/soo123","soo123","ksy9029");
                    System.out.println("java DB connected!");

                    //쿼리 선언 및 생성 
                    st = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE,
                    ResultSet.CONCUR_READ_ONLY);
                   
                    // writer.println(user_id);
                    // writer.flush(); 

                    
               // new Thread(new ChatTh(socket)).start(); //텍스트    
                //new Thread(new ChatTh2(socket)).start();
                // InputStream inputStream = socket.getInputStream();
            
                // InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
                
                // BufferedReader in = new BufferedReader(inputStreamReader);
                    
                    
                //5. 클라이언트에서 user_id 받아오기 
                // user_id = in.readLine();
                // writer = new PrintWriter(socket.getOutputStream());
                   
                
                // m_OutputList.put(user_id, new PrintWriter(socket.getOutputStream(),true));
                // System.out.println("m_OutputList : "+m_OutputList.toString());  
                
                // //6.해쉬맵에 user_id와 printWriter(writer)를 넣는다. (방구분하기 위해)
                //     hashMap.put(user_id,writer);
                //     System.out.println(hashMap);


                //     Map<String, PrintWriter> innerMap = new HashMap<>();
                    
                //    for(int i=0; i< allUsers.size(); i++ ){
                //     allUsers.put(user_id, innerMap);
                //    }
                //     innerMap.put(user_id, writer);
                
                //     System.out.println(allUsers.get(room_id).get(user_id));  


               // 6. user_id를 이용해 저장되어 있는 데이터를 가져온다.  
                //     String sql = "select * from chat_room inner join user on user_id_chat = id WHERE user_id_chat = " +user_id+" OR receiver = "+user_id ;
                //     System.out.println(sql);
                   
                //     //쿼리 실행 및 결과 저장
                //     rs = st.executeQuery(sql);
                //     ResultSetMetaData rsmd = rs.getMetaData();
                //     int columnCount = rsmd.getColumnCount();

                   
                   
                    
                //     jsonArray = new JsonArray();

                //     //결과 값 출력
                //    for(int i=1; i<= columnCount; i++) {
                //         while(rs.next()) {
                //             jsonObject = new JsonObject();
                //             jsonObject.addProperty("chat_id", rs.getString("chat_id"));
                //             jsonObject.addProperty("user_id_chat", rs.getString("user_id_chat"));
                //             jsonObject.addProperty("chat_text", rs.getString("chat_text"));
                //             jsonObject.addProperty("chat_date", rs.getString("chat_date"));
                //             jsonObject.addProperty("name", rs.getString("name"));
                //             jsonObject.addProperty("receiver", rs.getString("receiver"));
                //             jsonObject.addProperty("type", rs.getString("type"));
                //             System.out.println("JsonObject 생성 : " + jsonObject.toString() + "\n");
                           
                //             jsonArray.add(jsonObject);
                           
                //             //System.out.println("list 생성 : " + jsonArray.toString() + "\n");
    
                //         }
                       
                    
                //  }
                  
                // System.out.println("list2: "+jsonArray.toString());

                
              

                
                // //7. 클라이언트에 이미 저장되어 있는 데이터 문자열 전송
                // writer.println(jsonArray);
                // writer.flush(); 

                
               // m_OutputList.add(new PrintWriter(socket.getOutputStream(),true));
                // m_OutputList.put(user_id, new PrintWriter(socket.getOutputStream(),true));
                // System.out.println("m_OutputList : "+m_OutputList.toString());


                // getOutputStream으로 서버소켓과 연결된 클라이언트 소켓에 데이터를 보낸다.
                // PrintWriter를 사용하면 텍스트 형식으로 보낼 수 있다. 
                // 서버에서 보낼 데이터를 텍스트 형식으로 list에 넣는다.
                // true 인수는 메소드 호출 후에 데이터 자동비우기 설정임.
     
             

                //채팅에서 데이터 왔을 때 받는 쓰레드 (메세지 도착했을 때)
                //지금 각각은 되는데 합쳐서는 안됨.. 
              
                // new Thread(new ChatTh2(socket)).start();  //이미지
               // new Thread(new ChatTh2(socket)).start();  //이벤트 당첨자 스레드 
                new Thread(new ChatTh(socket)).start(); //텍스트
                


                //  sr = new ChatSverThread( socket, hashMap ); //ChatSverThread 객체를 Socket과 HashMap을 받아서 생성 후에 //ChatSverThread의 변수인 sr에 대입 
                //  t = new Thread(sr); //Thread객체를 ChatSverThread을 받아서 생성후 //Thread의 변수인 t에 대입 t.start();//쓰레드 시작
                }

                }
                catch (Exception e){
                    System.out.println("에러 : " + e.getMessage());
                }
           // }//while close
        }catch (Exception e){
            System.out.println("java DB fail!");
            System.out.println("에러 : " + e.getMessage());
        
    // } finally {
    //     try {
            
    //         // rs.close();
    //         // st.close();
    //         // con.close();
    //     } catch (SQLException e) {
    //         e.printStackTrace();
    //     }

    }
    }

   
  

    //클라이언트에서 받은 메세지 처리 
    //(디비에 저장, 클라이언트들로 보내준다. )
    static class ChatTh implements Runnable{
 
        private Socket socket;
 
        public ChatTh(Socket socket) throws IOException {
            this.socket = socket;
            
        }
 
        @Override
        public void run(){
            try {
 
                while (true) {
                   
                    //클라이언트에서 받은 메세지 처리 
                    // Process the received data
                    // Get the input stream and print the client information
                    InputStream inputStream = socket.getInputStream();
                    InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
                    BufferedReader in = new BufferedReader(inputStreamReader);
                    String getinput = in.readLine();

                    System.out.println(socket + " : 소켓에서 받는 데이터 : " + getinput);
                        
                   
                    //getinput(user_chat_id)가 DB안에 있으면 가장 최신의 데이터를 receiver에게 보낸다.
 
                    if(getinput != null){


                        JsonParser parser = new JsonParser();
                        JsonElement element = parser.parse(getinput);
                      
                        String type = element.getAsJsonObject().get("type").getAsString();
                        System.out.println("The type is: " + type);
                         
                        // String awsURL="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
                    
                        if(type.equals("1")){
                            System.out.println("이미지 스레드");
                           
                            // String s = getinput; //=getinput

                            // s = s.replace("[", "");
                            // s = s.replace("]", ""); 
                                               
                            //String[] strArr = s.split(","); //Splitting string into individual characters
                            // ArrayList<String> listImgData = new ArrayList<String>(Arrays.asList(strArr));
                            // //System.out.println("The String is: " + s);
                            // System.out.println("The ArrayList is: " + listImgData);
                            
                            // String USER_ID = listImgData.get(0).toString().trim(); 
                            // RECEIVER_ID = listImgData.get(1).toString().trim(); 


                            String USER_ID = element.getAsJsonObject().get("user_id_chat").getAsString();
                            String RECEIVER_ID = element.getAsJsonObject().get("receiver").getAsString();
                            
                            System.out.println("The USER_ID is: " + USER_ID);
                            System.out.println("The RECEIVER_ID is: " + RECEIVER_ID);
                            

                            try{
                                
                                String sql5="SELECT * FROM chat_room INNER JOIN user WHERE user_id_chat = id AND user_id_chat = "+USER_ID+" AND chat_id IN (SELECT MAX(chat_id) FROM chat_room GROUP BY user_id_chat) order by chat_id DESC Limit 1 ";
                                
                                
                                System.out.println(sql5);
                            
                                //쿼리 실행 및 결과 저장
                                rs = st.executeQuery(sql5);
                                ResultSetMetaData rsmd = rs.getMetaData();
                                int columnCount = rsmd.getColumnCount();
            
                                JsonArray jsonArray = new JsonArray();
                    
                                        //결과 값 출력
                                        for(int i=1; i<= columnCount; i++) {
                                                while(rs.next()) {
                                            
                                                    jsonObject = new JsonObject();
                                                    jsonObject.addProperty("chat_id", rs.getString("chat_id"));
                                                    jsonObject.addProperty("user_id_chat", rs.getString("user_id_chat"));
                                                    jsonObject.addProperty("chat_text", rs.getString("chat_text"));
                                                    jsonObject.addProperty("chat_date", rs.getString("chat_date"));
                                                    jsonObject.addProperty("name", rs.getString("name"));
                                                    jsonObject.addProperty("receiver", rs.getString("receiver"));
                                                    jsonObject.addProperty("type", rs.getString("type"));
                                                    System.out.println("JsonObject 생성 : " + jsonObject.toString() + "\n");
                                                
                                                    jsonArray.add(jsonObject);
                                                
                                                }

                                              
                                        
                                    
                                           }

                                           System.out.println("RECEIVER_ID 확인 : " + RECEIVER_ID);

                                           System.out.println("m_OutputList 이미지 전송하기 전  :  " +  m_OutputList.get(RECEIVER_ID));
                                           m_OutputList.get(RECEIVER_ID).println(jsonArray);
                                           m_OutputList.get(RECEIVER_ID).flush();

                                      
                                        // m_OutputList.get(rs.getString("receiver")).println(jsonArray);
                                        // m_OutputList.get(rs.getString("receiver")).flush();

                               
                                         System.out.println("이미지 전송완료");

                            }catch (Exception e){
                                                
                            }//cathch close

                        }else{
                        
                        System.out.println("텍스트 스레드");

                        System.out.println(socket + " 텍스트 : " + getinput);

                        String USER_ID = element.getAsJsonObject().get("user_id_chat").getAsString();
                        String RECEIVER_ID = element.getAsJsonObject().get("receiver").getAsString();
                        
                        //System.out.println("The USER_ID is: " + USER_ID);
                        System.out.println("The RECEIVER_ID is: " + RECEIVER_ID);
                        
                    
                        // JsonParser parser = new JsonParser();
                        // JsonElement element = parser.parse(getinput);

                        String user_id_chat = element.getAsJsonObject().get("user_id_chat").getAsString();
                        
                        String chat_date = element.getAsJsonObject().get("chat_date").getAsString();

                        String chat_text = element.getAsJsonObject().get("chat_text").getAsString();
                        System.out.println("chat_text = "+ chat_text);

                        String receiver = element.getAsJsonObject().get("receiver").getAsString();
                       
                    try{
                            Connection conn =  DriverManager.getConnection("jdbc:mysql://localhost/soo123","soo123","ksy9029");
                            System.out.println("java DB connected!");

                            //쿼리 선언 및 생성 //데이터 DB에 insert
                            String sql = "insert into chat_room(user_id_chat,chat_text,chat_date,receiver) values(?, ?, ?, ?)"; 

                            PreparedStatement pstmt =conn.prepareStatement(sql);
                            pstmt.setString(1, user_id_chat); 
                            pstmt.setString(2, chat_text); 
                            pstmt.setString(3, chat_date); 
                            pstmt.setString(4, receiver); 

                            int result = pstmt.executeUpdate();

                            if(result == 1) {
                                
                                    //스레드 돌려서 새롭게 저장된 내용(getinput)만 소켓 이용해 json형태로 보내기 
                                    //String sql2 = "select * from chat_room inner join user on user_id_chat = id WHERE user_id_chat = " +user_id_chat+" OR receiver = "+user_id_chat;
                                    String sql4="SELECT * FROM chat_room INNER JOIN user WHERE user_id_chat = id AND chat_id IN (SELECT MAX(chat_id) FROM chat_room GROUP BY user_id_chat) order by chat_id DESC Limit 1 ";
                                
                                    System.out.println(sql4);
                                
                                    //쿼리 실행 및 결과 저장
                                    rs = st.executeQuery(sql4);
                                    ResultSetMetaData rsmd = rs.getMetaData();
                                    int columnCount = rsmd.getColumnCount();
                
                                    JsonArray jsonArray = new JsonArray();
                
                                    //결과 값 출력
                               for(int i=1; i<= columnCount; i++) {
                                    while(rs.next()) {
                                  
                                        jsonObject = new JsonObject();
                                        jsonObject.addProperty("chat_id", rs.getString("chat_id"));
                                        jsonObject.addProperty("user_id_chat", rs.getString("user_id_chat"));
                                        jsonObject.addProperty("chat_text", rs.getString("chat_text"));
                                        jsonObject.addProperty("chat_date", rs.getString("chat_date"));
                                        jsonObject.addProperty("name", rs.getString("name"));
                                        jsonObject.addProperty("receiver", rs.getString("receiver"));
                                        jsonObject.addProperty("type", rs.getString("type"));
                                        System.out.println("JsonObject 생성 : " + jsonObject.toString() + "\n");
                                       
                                        jsonArray.add(jsonObject);
                                       
                                    }
                                   
                                
                                }
                              

                            //보낸사람과 받는 사람에게 디비에 저장된 내용 소켓으로 보낸다. 
                           // m_OutputList.get(USER_ID).println(jsonArray);
                            // System.out.println("user_id_chat 스트림 get 했니? : " +  m_OutputList.get(user_id_chat) + "\n");
                                       
                            m_OutputList.get(RECEIVER_ID).println(jsonArray);
                            System.out.println("receiver 스트림 get 했니?? : " + m_OutputList.get(receiver) + "\n");
                            m_OutputList.get(RECEIVER_ID).flush();//받는사람에게 보내기
                            System.out.println(" 확인2 " + "\n");

                           // m_OutputList.get(USER_ID).flush();//보내는 사람에게 보내기
                            // System.out.println(" 확인1 " + "\n");

                            

                            //  for(int i=0;i<m_OutputList.size();++i){

                            //         m_OutputList.get(i).println(jsonArray);
                            //         m_OutputList.get(i).flush();
                            //  }

                            System.out.println(" 전송 완료..! " + "\n");

                            System.out.println("insert 저장 성공!");
                                
                                    
    

                            }else{
                                System.out.println("저장 실패");}
                                getinput = null;

                      }
                      catch (SQLException e){
                            e.printStackTrace();
                                            
                        }

                  
                    }
                }//get input
                    
                }//while close



                
            }//try close
            catch (Exception e){
                e.printStackTrace();
             }
             
        }//run close

        
    }//chatTh close


    // //이미지 띄우는 쓰레드 
    // static class ChatTh2 implements Runnable{

    //     private Socket socket;
 
    //     public ChatTh2(Socket socket) throws IOException {
    //         this.socket = socket;
            
    //     }
 
    //     @Override
    //     public void run(){
    //         try {

    //             while (true) {

    //                 //클라이언트에서 받은 메세지 처리 
    //                 // Process the received data
    //                 // Get the input stream and print the client information
    //                 InputStream inputStream = socket.getInputStream();
    //                 InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
    //                 BufferedReader in = new BufferedReader(inputStreamReader);
    //                 String getinput = in.readLine();

    //                 System.out.println(socket + " : " + getinput);

    //                 String awsURL="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
                    
    //                 if(getinput != null){
    //                     if(getinput.contains(awsURL)){

                           
    //                         String s = getinput; //=getinput

    //                         s = s.replace("[", "");
    //                         s = s.replace("]", ""); 
                                               
    //                         String[] strArr = s.split(","); //Splitting string into individual characters
    //                         ArrayList<String> listImgData = new ArrayList<String>(Arrays.asList(strArr));
    //                         System.out.println("The String is: " + s);
    //                         System.out.println("The ArrayList is: " + listImgData);
                            
    //                         String USER_ID = listImgData.get(0).toString().trim(); 
    //                         RECEIVER_ID = listImgData.get(1).toString().trim(); 
    //                         System.out.println("The USER_ID is: " + USER_ID);
    //                         System.out.println("The RECEIVER_ID is: " + RECEIVER_ID);
                            

    //                         try{
                                
    //                             String sql5="SELECT * FROM chat_room INNER JOIN user WHERE user_id_chat = id AND user_id_chat = "+USER_ID+" AND chat_id IN (SELECT MAX(chat_id) FROM chat_room GROUP BY user_id_chat) order by chat_id DESC Limit 1 ";
                                
                                
    //                             System.out.println(sql5);
                            
    //                             //쿼리 실행 및 결과 저장
    //                             rs = st.executeQuery(sql5);
    //                             ResultSetMetaData rsmd = rs.getMetaData();
    //                             int columnCount = rsmd.getColumnCount();
            
    //                             JsonArray jsonArray = new JsonArray();
            
    //                             //결과 값 출력
    //                             for(int i=1; i<= columnCount; i++) {
    //                                     while(rs.next()) {
                                    
    //                                         jsonObject = new JsonObject();
    //                                         jsonObject.addProperty("chat_id", rs.getString("chat_id"));
    //                                         jsonObject.addProperty("user_id_chat", rs.getString("user_id_chat"));
    //                                         jsonObject.addProperty("chat_text", rs.getString("chat_text"));
    //                                         jsonObject.addProperty("chat_date", rs.getString("chat_date"));
    //                                         jsonObject.addProperty("name", rs.getString("name"));
    //                                         jsonObject.addProperty("receiver", rs.getString("receiver"));
    //                                         jsonObject.addProperty("type", rs.getString("type"));
    //                                         System.out.println("JsonObject 생성 : " + jsonObject.toString() + "\n");
                                        
    //                                         jsonArray.add(jsonObject);
                                        
    //                                     }
                                
                            
    //                              }


    //                              System.out.println("m_OutputList 이미지 전송하기 전  :  " + m_OutputList);
    //                              m_OutputList.get(RECEIVER_ID).println(jsonArray);
    //                              System.out.println("RECEIVER_ID,jsonArray ");

    //                              m_OutputList.get(RECEIVER_ID).flush();
    //                             // m_OutputList.get(receiver).println(jsonArray);
    //                             // m_OutputList.get(receiver).flush();

                               
    //                         System.out.println("전송완료");

    //                         }catch (Exception e){
                                                
    //                         }


    //                     }

    //                 }
    //             }


    //         }catch (Exception e){
    //             e.printStackTrace();
    //         }





    // }
            
   
    

   

    //}
}//chatServer class close.