package main;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Frame;
import java.awt.Toolkit;
import java.awt.Window;
import javax.swing.BoxLayout;
//import javax.swing.JApplet;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import java.io.*;

public class Exam {
	
	private static final long serialVersionUID = 1L;
	private static Window mainWindow;
	private static JPanel wrapperPanel;
	private static JPanel headerPanel;
	private static JPanel examPanel;
	
	public static void main(String[] args) {
		//connect to Mysql DB
		boolean con = SQLhelper.conDB();
		if (!con) {
			System.out.println("ERROR");
		} else {
			getGUI();
		}
	}
	
	public static void getGUI() {
		mainWindow = new Window(new Frame());
		
		// Get screen resolution and set mainWindow to fullscreen
		Dimension ss = Toolkit.getDefaultToolkit().getScreenSize();
		mainWindow.setBounds(0, 0, ss.width, ss.height);
		
		//Window size should be an integer (i.e whole number)
		
		//Create Wrapper http://docs.oracle.com/javase/tutorial/uiswing/layout/box.html#alignment
		wrapperPanel = new JPanel();
		wrapperPanel.setPreferredSize(new Dimension(800, ss.height));
		wrapperPanel.setBackground(Color.black);
//		wrapperPanel.setOpaque(true);
		wrapperPanel.setLayout(new BoxLayout(wrapperPanel, BoxLayout.PAGE_AXIS));
		wrapperPanel.setVisible(true);
		
		//Create headerPanel
		headerPanel = new JPanel();
		headerPanel.setPreferredSize(new Dimension(100, 100));
		headerPanel.setBackground(Color.white);
		
		//Create examPanel
		examPanel = new JPanel();
		examPanel.setPreferredSize(new Dimension(100, 300));
		examPanel.setBackground(Color.blue);// May make this tranparent in the future
		examPanel.setLayout(new BorderLayout()); 
		
		//Create JScrollPane, and place examPanel in it.
		JScrollPane js = new JScrollPane(examPanel);
		js.setBorder(null);
		
		//Add primary panels to wrapper
		wrapperPanel.add(headerPanel, BoxLayout.Y_AXIS);
		wrapperPanel.add(examPanel, BoxLayout.X_AXIS);
		
		// add panels to window
		mainWindow.add(wrapperPanel);	
		
		// make this visible
		mainWindow.setVisible(true);
		mainWindow.setAlwaysOnTop(true);
		return;
	}
	
	
	
}	
