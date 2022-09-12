print("<-------------------------------------------PUZZLE GAME---------------------------------------------------------------------->")
def game(n,m):
    point=0
    x=1
    c=0
    #while(x<=len(n)):
    for e in n:
        print("print the correct word:-",m[c])
        print(">>>",end=' ')
        if(e==input()):
            print("correct")
            point+=1
        else:
            print("wrong")
            point-=1
        c+=1
    print("your net point is:-",point)

    print()
    print("<--------------------------------------------Thank You--------------------------------------------------------------------------->")





l=['Brake','aeroplane','green','energy','Chocolate']
k=['rakeB','opanelera','egrne','rgeyne','ateCholoc']
game(l,k)