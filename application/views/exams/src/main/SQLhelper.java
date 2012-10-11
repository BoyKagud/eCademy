package main;

import java.sql.DriverManager;
import java.sql.Connection;
import java.sql.SQLException;

public class SQLhelper {

	public static boolean conDB() {
		System.out.println("-------- MySQL JDBC Connection Testing ------------");
		 
		try {
 
			Class.forName("com.mysql.jdbc.Driver");
 
		} catch (ClassNotFoundException e) {
 
			System.out.println("Where is your MySQL JDBC Driver?");
			e.printStackTrace();
			return false;
		}
 
		System.out.println("MySQL JDBC Driver Registered!");
		Connection connection = null;
 
		try {
			connection = DriverManager
					.getConnection("jdbc:mysql://localhost",
							"ecademy", "admin");
 
		} catch (SQLException e) {
			System.out.println("Connection Failed! Check output console");
			e.printStackTrace();
			return false;
		}
 
		if (connection != null) {
			System.out.println("DB connection Succeeded!");
			return true;
		} else {
			System.out.println("Failed to make connection!");
			return false;
		}
	}

}
