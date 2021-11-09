

public class DataChatUser {
 
    Socket userSocket;
    int roomNo;
    String Userid;
    DataOutputStream output;
    
    public DataChatUser(Socket userSocket,int roomNo, String UserId, DataOutputStream output) {
     
     this.userSocket = userSocket;
     this.roomNo = roomNo;
     this.Userid = UserId;
     this.output = output;
    }
   
   }