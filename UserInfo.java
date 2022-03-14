import java.util.*;
import java.io.*;

public class UserInfo{

    private int user_uid;
    private ArrayList<PrintWriter> m_OutputList;


    public UserInfo(int user_uid, ArrayList<PrintWriter> m_OutputList ) {
        this.user_uid = user_uid;
        this.m_OutputList = m_OutputList;

    }

    

	public int getUser_uid() {
		return this.user_uid;
	}

	public void setUser_uid(int user_uid) {
		this.user_uid = user_uid;
	}

	public ArrayList<PrintWriter> getM_OutputList() {
		return this.m_OutputList;
	}

	public void setM_OutputList(ArrayList<PrintWriter> m_OutputList) {
		this.m_OutputList = m_OutputList;
	}


  







}