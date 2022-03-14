public class socketService extends Service {

    Socket s;
    PrintStream os;

    public socketService(){


    }

    @Override
    public IBinder onBind(Intent arg0) {
        // TODO Auto-generated method stub


        return myBinder;
    }

    private final IBinder myBinder = new LocalBinder();

    public class LocalBinder extends Binder {
        public SocketService getService() {
            return SocketService.this;
        }
    }
    @Override
    public void onCreate() { //자동 오버라이드 //on StartCommand on Destroy
        super.onCreate();
        s = new Socket();

       
    }

    public void IsBoundable(){
        Toast.makeText(this,"I bind like butter", Toast.LENGTH_LONG).show();
    }

    public void onStart(Intent intent, int startId){
        super.onStart(intent, startId);
        Toast.makeText(this,"Service created ...", Toast.LENGTH_LONG).show();
        Runnable connect = new connectSocket();
        new Thread(connect).start();
    }


    class connectSocket implements Runnable {

        @Override
        public void run() {
            SocketAddress socketAddress = new InetSocketAddress("192.168.1.104", 6137);
            try {               
                s.connect(socketAddress);
            } catch (IOException e) {
                e.printStackTrace();
            }

        }

    }


    @Override
    public void onDestroy() {
        super.onDestroy();
        try {
            s.close();
        } catch (IOException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
        s = null;
    }
}
