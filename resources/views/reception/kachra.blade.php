

@if($status === 'pending')
    
    <td class="px-4 py-2">
        <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to approve this appointment?')">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline">To - Approve</button>
        </form>
    </td>

@elseif($status === 'approved')
    
    <td class="px-4 py-2">
        <form action="{{ route('appointments.in_progress', $appointment->id) }}" method="POST"
            onsubmit="return confirm('Mark this appointment as In Progress?')">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline">To - In
                Progress</button>
        </form>
    </td>

@elseif($status === 'completed')
    
    <td class="px-4 py-2">
        <h2 class="text-blue-600 ">Done</h2>
    </td>
@elseif($status === 'cancelled')
    
    <td class="px-4 py-2">
        <button class="text-blue-600 hover:underline">Check-in</button>
    </td>
@elseif($status === 'rescheduled')
    
    <td class="px-4 py-2">
        <button class="text-blue-600 hover:underline">Check-in</button>
    </td>
@elseif($status === 'in_progress')
    
    <td class="px-4 py-2">
        <form action="{{ route('appointments.checkin', $appointment->id) }}" method="POST"
            onsubmit="return confirm('Mark as checked-in?')">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline">Check-in</button>
        </form>
    </td>

@elseif($status === 'checked_in')
    
    <td class="px-4 py-2">
        <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST"
            onsubmit="return confirm('Mark this appointment as completed?')">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline">Complete</button>
        </form>
    </td>

@elseif($status === 'no_show')
    
    <td class="px-4 py-2">
        <button class="text-blue-600 hover:underline">Check-in</button>
    </td>
@elseif($status === 'rejected')
    
    <td class="px-4 py-2">
        <button class="text-blue-600 hover:underline">Check-in</button>
    </td>
@else
    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600 capitalize">{{ $status }}</span>
@endif