import java.util.Scanner;


public class digitname {
	public static void main(String[] args) {
		Scanner kb = new Scanner(System.in);
		int x = kb.nextInt();
		Circle c1 = new Circle(x);
		if(c1.reCircle() == 1){
			System.out.println("one");
		}else if(c1.reCircle() == 2){
			System.out.println("two");
		}else if(c1.reCircle() == 3){
			System.out.println("three");
		}else if(c1.reCircle() == 4){
			System.out.println("four");
		}else if(c1.reCircle() == 5){
			System.out.println("five");
		}else if(c1.reCircle() == 6){
			System.out.println("six");
		}else if(c1.reCircle() == 7){
			System.out.println("seven");
		}else if(c1.reCircle() == 8){
			System.out.println("eight");
		}else if(c1.reCircle() == 9){
			System.out.println("nine");
		}else if(c1.reCircle() == 10){
			System.out.println("ten");
		}
	}
}
