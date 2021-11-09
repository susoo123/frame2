import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

public class ClientManagerThread extends Thread{

    private Socket m_socket;
   // private String m_ID;

   private String nickname= null;
  
  
  

    @Override
    public void run(){
        super.run();
        try{
            //getInputStream -> InputStreamReader -> BufferedReader 순으로 클라이언트에서 보낸 데이터를 읽어옴.
            BufferedReader in = new BufferedReader(new InputStreamReader(m_socket.getInputStream()));
            
            
            //PrintWriter printWriter = new PrintWriter(new OutputStreamWriter(m_socket.getOutputStream(), StandardCharsets.UTF_8));

            while(true){
               
                String text = in.readLine(); //text는 String이고, 데이터를 String으로 읽어옴. 

                if(text!=null) { //데이터가 null이 아니면 (클라이언트에서 준 데이터가 있으면 )
                    for(int i=0;i<MyServer.m_OutputList.size();++i){
                        MyServer.m_OutputList.get(i).println(text);
                        MyServer.m_OutputList.get(i).flush();
                    }
                }

            }

        }catch(IOException e){
            e.printStackTrace();
            //consoleLog(this.nickname + "님이 채팅방을 나갔습니다.");
        }
    }


    public void setSocket(Socket _socket){
        m_socket = _socket;
    }





   
}