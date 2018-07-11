import numpy as np
import matplotlib.pyplot as plt
# import matplotlib as mpl

# BEST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 13], [360,0], 'og--')
# WORST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 15], [360,0], 'or--') 
# NOW EFFORT
# x(...), y(...)
# plt.plot([0, 1, 2], [0,0,0], 'ob-') 
# LEFT
# x(days), y(hoursLeft)
# plt.plot([0, 1, 2], [0,0,0], 'oc-') 

# DAILY WRKDONE
days = (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16)
workdone = [0, 0, 0, 0, 0 ,0 ,0 ,0 ,0 ,0, 0, 0, 0, 0, 0, 0]
y_pos = np.arange(len(days))
plt.bar(y_pos, workdone, width=0.5, color="yellow",edgecolor = "black") 
plt.xticks(y_pos, days)

# AXIS
plt.grid()
plt.axis([0,17,0,360])
plt.xlabel('Days')
plt.ylabel('Remaining effort (hours)')
plt.title('Burn-down chart')

#SHOW
plt.show()
