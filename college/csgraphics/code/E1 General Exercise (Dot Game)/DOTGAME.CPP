#include<stdio.h>
#include<conio.h>
#include<graphics.h>

int fillSquare(int x,int y,int i)
{
	if(i%2==0)
	{
		setfillstyle(SOLID_FILL,RED);
	}
	else
	{
		setfillstyle(SOLID_FILL,YELLOW);
	}
	floodfill(x,y,WHITE);
    return 0;
}
int main()
{
    int gd = DETECT,gm;
    initgraph(&gd,&gm,"C:\\TC\\BGI");
    int i,j;
    int n;
    scanf("%d",&n);
    int z = 250;
    int y = z;
    for(i=0;i<n;i++)
    {
        y += 75;
        int x = z;
        for(j=0;j<n;j++)
        {
            x += 75;
            setfillstyle(SOLID_FILL, WHITE);
            circle(x,y,4);
            floodfill(x,y,WHITE);
        }
    }
    int totalTurns = 2*n*(n-1);
    int p1Count = 0, p2Count = 0;
    int check[26][4] = {0};
    i=0;
    for(j=0;j<totalTurns;j++)
    {
        if(i%2 == 0)
            printf("Player1's turn.");
        else
            printf("Player2's turn.");
        int x1,y1,x2,y2;
        abc:
        printf("Enter coordinates.");
        scanf("%d %d %d %d",&x1,&y1,&x2,&y2);
        int num1 = n*(x1-1) + y1;
        int num2 = n*(x2-1) + y2;
        int flag=0;
        if(num1 == num2 - 1)
        {
            if(check[num1][1] == 1)
            {
                printf("The line already exists. Please select other coordinates.\n");
                goto abc;
            }
            check[num1][1] = 1;
            check[num2][3] = 1;
            setcolor(WHITE);
            setlinestyle(SOLID_LINE,0,3);
            line(z+75*y1,z+75*x1,z+75*y2,z+75*x2);
            if(num1<=(n-1)*n)
            {
                if(check[num1][1] == 1 && check[num1][2] == 1&& check[num2+n][0] == 1 && check[num2+n][3] == 1)
                {
                    if(i%2 == 0)
                        p1Count += 1;
                    else
                        p2Count += 1;
                    fillSquare(z+75*y1+50,z+75*x1+50,i);
                    flag++;
                }
            }
            if(num1>n)
            {
                if(check[num1][1] == 1 && check[num1][0] == 1&& check[num2-n][2] == 1 && check[num2-n][3] == 1)
                {
                    if(i%2 == 0)
                    	p1Count += 1;
                    else
                       p2Count += 1;
                    fillSquare(z+75*y1+50,z+75*x1-50,i);
                    flag++;
                }
            }

        }
        else if(num2 == num1 - 1)
        {
             if(check[num1][3] == 1)
            {
                printf("The line already exists. Please select other coordinates.\n");
                goto abc;
            }
            check[num1][3] = 1;
            check[num2][1] = 1;
            int temp;
            temp = num1;
            num1 = num2;
            num2 = temp;
            setlinestyle(SOLID_LINE,0,3);
            line(z+75*y1,z+75*x1,z+75*y2,z+75*x2);
            if(num1<=n*(n-1))
            {
                if(check[num1][1] == 1 && check[num1][2] == 1&& check[num2+n][0] == 1 && check[num2+n][3] == 1)
                {
                    if(i%2 == 0)
                        p1Count += 1;
                    else
                       p2Count += 1;
                    fillSquare(z+75*y2+50,z+75*x2+50,i);
                    flag++;
                }
            }
            if(num1>n)
            {
                if(check[num1][1] == 1 && check[num1][0] == 1&& check[num2-n][2] == 1 && check[num2-n][3] == 1)
                {
                    if(i%2 == 0)
                       p1Count += 1;
                    else
                       p2Count += 1;

                    fillSquare(z+75*y2+50,z+75*x2-50,i);
                    flag++;
                }
            }
        }
        else if(num1 == num2 - n)
        {
             if(check[num1][2] == 1)
            {
                printf("The line already exists. Please select other coordinates.\n");
                goto abc;
            }
            check[num1][2] = 1;
            check[num2][0] = 1;
            setlinestyle(SOLID_LINE,0,3);
            line(z+75*y1,z+75*x1,z+75*y2,z+75*x2);
            if(num1%n!=0)
            {
                if(check[num1][1] == 1 && check[num1][2] == 1&& check[num2+1][0] == 1 && check[num2+1][3] == 1)
                {
                    if(i%2 == 0)
                        p1Count += 1;
                    else
                       p2Count += 1;
                    fillSquare(z+75*y1+50,z+75*x1+50,i);
                }
            }
            if(num1%n!=1)
            {
                if(check[num1][3] == 1 && check[num1][2] == 1&& check[num2-1][0] == 1 && check[num2-1][1] == 1)
                {
                    if(i%2 == 0)
                       p1Count += 1;
                    else
                        p2Count += 1;
                    fillSquare(z+75*y1-50,z+75*x1+50,i);
                    flag++;
                }
            }
        }
        else if(num2 == num1 - n)
        {
             if(check[num1][0] == 1)
            {
                printf("The line already exists. Please select other coordinates.\n");
                goto abc;
            }
            check[num1][0] = 1;
            check[num2][2] = 1;
            int temp;
            temp = num1;
            num1 = num2;
            num2 = temp;
            setlinestyle(SOLID_LINE,0,3);
            line(z+75*y1,z+75*x1,z+75*y2,z+75*x2);
            if(num1%n!=0)
            {
                if(check[num1][1] == 1 && check[num1][2] == 1&& check[num2+1][0] == 1 && check[num2+1][3] == 1)
                {
                    if(i%2 == 0)
                       p1Count += 1;
                    else
                       p2Count += 1;
                    fillSquare(z+75*y2+50,z+75*x2+50,i);
                    flag++;
                }
            }
            if(num1%n!=1)
            {
                if(check[num1][3] == 1 && check[num1][2] == 1&& check[num2-1][0] == 1 && check[num2-1][1] == 1)
                {
                    if(i%2 == 0)
                       p1Count += 1;
                    else
                       p2Count += 1;
                    fillSquare(z+75*y2-50,z+75*x2+50,i);
                    flag++;
                }
            }

        }
        else
        {
            printf("Invalid input. Please try again.\n");
            goto abc;
        }
        if(flag>0 && j!=totalTurns-1)
        {
            if(i%2 == 0)
                printf("Again its player1's turn.");
            else
                printf("Again its player2's turn.");
            j++;
            goto abc;
        }
        else
            i++;

    }
    if(p1Count>p2Count)
        printf("Player1 Wins!");
    else if(p2Count>p1Count)
        printf("Player2 Wins!");
    else
        printf("It's a draw.");
    getch();
    return 0;
}
