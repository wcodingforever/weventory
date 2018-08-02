import numpy as np
import matplotlib.pyplot as plt
# import matplotlib as mpl

# BEST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 11], [183,0], 'og--')
# WORST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 13], [183,0], 'or--') 
# NOW EFFORT
# x(...), y(...)

plt.plot([0, 1, 2, 3, 4, 5, 6, 7], [183,170,150,123,108,98,91,83], 'ob-') 

# LEFT
# x(days), y(hoursLeft)
plt.plot([0, 1, 2, 3, 4, 5, 6, 7], [183,179,159,141,125,115,103,102], 'oc-') 

# DAILY WRKDONE
days = (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14)
workdone = [4, 20, 18, 16, 10 ,7 ,8 ,0 ,0 ,0, 0, 0, 0, 0, 0]
y_pos = np.arange(len(days))
plt.bar(y_pos, workdone, width=0.5, color="yellow",edgecolor = "black") 
plt.xticks(y_pos, days)

# AXIS
plt.grid()
plt.axis([0,15,0,200])
plt.xlabel('Days')
plt.ylabel('Remaining effort (hours)')
plt.title('Burn-down chart')

#SHOW
plt.show()

#5/10 4/8
#EFFORT
#
#tasks
#